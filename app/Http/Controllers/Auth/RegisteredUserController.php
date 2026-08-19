<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Models\Organization;
use App\Models\User;
use App\Repositories\InstructorRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PageRepository;
use App\Traits\SendMailTrait;
use App\Traits\SendNotification;
use App\Traits\SmsSenderTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use SendMailTrait, SendNotification, SmsSenderTrait;

    protected $organization;

    protected $instructor;

    public function __construct(OrganizationRepository $organization, InstructorRepository $instructor)
    {
        $this->organization = $organization;
        $this->instructor   = $instructor;
    }

    public function create(): View
    {
        $pageRepository = app(PageRepository::class);
        $privacy        = $pageRepository->get(setting('privacy_agreement'));
        $terms          = $pageRepository->get(setting('terms_agreement'));
        $data           = [
            'privacy_url'     => $privacy ? url('page/' . $privacy->link) : '#',
            'terms_condition' => $terms ? url('page/' . $terms->link) : '#',
        ];

        return view('frontend.auth.sign_up', $data);
    }

    // student register

    public function store(Request $request) //: RedirectResponse
    {
        if ($request->user_type == 'instructor') {
            $orgName = trim($request->first_name . ' ' . $request->last_name);
            $request->merge([
                'organization_id' => $orgName
            ]);
        }

        $request->validate([
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255'],
            'password'        => ['required', 'confirmed', 'string', 'min:6'],
            'phone'           => ['required'],
            'terms_condition' => ['required'],
        ]);

        // Check if verified user exists with email
        $existingEmailUser = User::where('email', $request->email)->first();
        if ($existingEmailUser && $existingEmailUser->status == 1) {
            Toastr::warning(__('email_already_registered_please_login'));
            return redirect()->route('login');
        }

        // Check if verified user exists with phone
        $existingPhoneUser = User::where('phone', $request->phone)->first();
        if ($existingPhoneUser && $existingPhoneUser->status == 1) {
            Toastr::warning(__('phone_already_registered_please_login'));
            return redirect()->route('login');
        }

        // Clean up unverified garbage accounts if they exist with this email or phone
        User::where('email', $request->email)->where('status', 0)->delete();
        User::where('phone', $request->phone)->where('status', 0)->delete();

        try {
            DB::beginTransaction();
            $user                   = new User();
            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->phone_country_id = $request->phone_country_id;
            $user->phone            = $request->phone;
            $user->password         = Hash::make($request->password);
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->status = 0;

            if (setting('disable_email_confirmation') == 1) {
                $user->email_verified_at = now();
            }

            if (empty($request->organization_id)) {
                $user->role_id = 3;
                $user->save();
                event(new Registered($user));

                $this->sendSMS($this->getFormattedPhone($user), 'register', $otp);
                DB::commit();
                Toastr::success(__('an_otp_sent_to_your_phone'));
                return redirect()->route('register.confirm.otp', ['phone' => $user->phone]);

                if (setting('disable_email_confirmation') == 1) {
                    Toastr::success(__('registration_completed_successfully'));
                    Auth::login($user);
                }
                DB::commit();

                return $this->emailConfirmation($request);
            } elseif (! empty($request->organization_id)) {
                if ($this->organization->find(1000)) {
                    $this->instructor->store($request->all());
                    $instructor = User::where('email', $request->email)->first();

                    $otp = rand(1000, 9999);
                    $instructor->otp = $otp;
                    $instructor->status = 0;
                    $instructor->save();

                    $this->sendSMS($this->getFormattedPhone($instructor), 'register', $otp);
                    event(new Registered($instructor));
                    DB::commit();
                    Toastr::success(__('an_otp_sent_to_your_phone'));
                    return redirect()->route('register.confirm.otp', ['phone' => $instructor->phone]);

                    event(new Registered($instructor));
                    Auth::login($instructor);
                    DB::commit();

                    return $this->emailConfirmation($request);
                } else {
                    $request['org_name']     = $request->organization_id;
                    $request['person_name']  = $request->first_name.' '.$request->last_name;
                    $request['person_email'] = $request->email;
                    $request['person_phone'] = $request->phone;
                    if ($this->organization->store($request->all())) {
                        $organization               = Organization::select('id')->where('email', $request->email)->first();
                        $request['organization_id'] = $organization->id;
                        $this->instructor->store($request->all());
                        $instructor                 = User::where('email', $request->email)->first();

                        $otp = rand(1000, 9999);
                        $instructor->otp = $otp;
                        $instructor->status = 0;
                        $instructor->save();

                        $this->sendSMS($this->getFormattedPhone($instructor), 'register', $otp);
                        event(new Registered($instructor));
                        DB::commit();
                        Toastr::success(__('an_otp_sent_to_your_phone'));
                        return redirect()->route('register.confirm.otp', ['phone' => $instructor->phone]);

                        event(new Registered($instructor));
                        Auth::login($instructor);
                        DB::commit();

                        return $this->emailConfirmation($request);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function emailConfirmation(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (setting('disable_email_confirmation') != 1) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $data['user_id'] = $user->id;
            $data['code']    = Str::random(32);
            $activation      = Activation::create($data);
            $data            = [
                'user'              => $user,
                'user_id'           => $user->id,
                'code'              => $activation->code,
                'confirmation_link' => url('/').'/activation/'.$request->email.'/'.$activation->code,
                'template_title'    => 'email_confirmation',
            ];
            $this->sendmail($request->email, 'emails.template_mail', $data);
            Toastr::success(__('user_register_hints'));

            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }

    public function confirmRegisterOtp($phone)
    {
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            Toastr::warning(__('user_not_found'));
            return redirect()->route('register');
        }
        
        $otp_array = array_map('intval', str_split($user->otp ?? '0000'));
        $data = [
            'user'      => $user,
            'otp_array' => $otp_array,
            'phone'     => $phone,
        ];

        return view('frontend.auth.register_otp', $data);
    }

    public function registerOtpSubmit(Request $request)
    {
        $request->validate([
            'first'  => ['required', 'numeric', 'digits:1'],
            'second' => ['required', 'numeric', 'digits:1'],
            'third'  => ['required', 'numeric', 'digits:1'],
            'fourth' => ['required', 'numeric', 'digits:1'],
            'phone'  => ['required', 'string'],
        ]);

        try {
            $otp = $request->first.$request->second.$request->third.$request->fourth;
            $user = User::where('phone', $request->phone)->first();
            
            if (!$user) {
                Toastr::warning(__('user_not_found'));
                return redirect()->route('register');
            }

            if ($user->otp != $otp) {
                Toastr::warning(__('sorry_otp_not_match'));
                return redirect()->back()->withInput();
            }

            // OTP verified! Verify user and log in.
            $user->otp = null;
            $user->status = 1;
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);
            Toastr::success(__('registration_completed_successfully'));

            return redirect()->route('home');

        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function resendRegisterOtp($phone)
    {
        $user = User::where('phone', $phone)->where('status', 0)->first();
        if (!$user) {
            Toastr::warning(__('user_not_found'));
            return redirect()->route('register');
        }

        // Generate a new OTP code
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->save();

        // Send SMS
        $this->sendSMS($this->getFormattedPhone($user), 'register', $otp);

        Toastr::success(__('otp_has_been_sent_to_your_mobile'));
        return redirect()->route('register.confirm.otp', ['phone' => $phone]);
    }

    private function getFormattedPhone($user)
    {
        $phone = $user->phone;
        if (!str_starts_with($phone, '+') && !empty($user->phone_country_id)) {
            $country = \App\Models\Country::find($user->phone_country_id);
            if ($country) {
                $cleaned_phone = ltrim($phone, '0');
                $phone = '+' . $country->phonecode . $cleaned_phone;
            }
        }
        return $phone;
    }
}
