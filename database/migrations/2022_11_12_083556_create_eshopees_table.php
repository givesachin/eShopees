<?php

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
        Schema::create('category', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('attachment_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('attachment', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('filename');
            $table->string('size');
            $table->string('extension');
            $table->string('path');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('sms_log', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('to');
            $table->string('message_id');
            $table->string('type');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('payment', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('razorpay_order_id');
            $table->string('razorpay_payment_id')->nullable();
            $table->string('method')->nullable();
            $table->double('amount')->unsigned();
            $table->integer('status')->unsigned()->default(0);
            $table->string('refund_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('integration', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('integration_name');
            $table->string('code');
            $table->string('value')->nullable();
            $table->timestamps();
        });

        Schema::create('organization', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('org_name');
            $table->string('org_phone');
            $table->string('org_email');
            $table->string('org_whatsapp_phone')->nullable();
            $table->string('org_whatsapp_message')->nullable();
            $table->string('org_logo_path')->nullable();
            $table->string('org_logo2_path')->nullable();
            $table->string('org_facebook_link')->nullable();
            $table->string('org_instagram_link')->nullable();
            $table->string('org_twitter_link')->nullable();
            $table->string('org_location_address')->nullable();
            $table->string('org_location_link')->nullable();
            $table->integer('org_appoinment_fee')->unsigned()->default(0);
            $table->string('default_image_id')->nullable();
            $table->string('default_image_path')->nullable();
            $table->string('version');
            $table->string('developed_by')->nullable();
            $table->string('developer_link')->nullable();
            $table->boolean('email_queue')->default(1);
            $table->boolean('sms_queue')->default(1);
            $table->bigInteger('sms_balance')->default(0);
            $table->bigInteger('sms_used')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshopees');
    }
};
