<?php

use App\Models\PageLanguage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->nullable();
            $table->string('lang', 50)->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        $data = [
            [
                'page_id'          => 404,
                'lang'             => 'en',
                'title'            => 'Page Not Found.',
                'content'          => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Please return to the homepage.',
                'meta_title'       => 'Page Not Found.',
                'meta_keywords'    => 'Page Not Found.',
                'meta_description' => 'The requested page could not be found.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'page_id'          => 403,
                'lang'             => 'en',
                'title'            => 'Permission Denied.',
                'content'          => 'You do not have permission to access this resource. If you believe this is an error, please contact support.',
                'meta_title'       => 'Permission Denied.',
                'meta_keywords'    => 'Permission Denied.',
                'meta_description' => 'You do not have permission to access this page.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'page_id'          => 500,
                'lang'             => 'en',
                'title'            => 'Internal Server Error.',
                'content'          => 'An unexpected condition was encountered by the server that prevented it from fulfilling the request. We are working to resolve it.',
                'meta_title'       => 'Internal Server Error.',
                'meta_keywords'    => 'Internal Server Error.',
                'meta_description' => 'An internal server error occurred.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        PageLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_languages');
    }
};
