<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('ref_code')->primary();
            /**
             * @var \Callmeaf\User\App\Repo\Contracts\UserRepoInterface $userRepo
             */
            $userRepo = app(\Callmeaf\User\App\Repo\Contracts\UserRepoInterface::class);
            $table->string('sender_identifier')->nullable();
            $table->foreign('sender_identifier')->references($userRepo->getModel()->identifierKey())->on($userRepo->getTable())->cascadeOnUpdate()->nullOnDelete();

            $table->string('receiver_identifier')->nullable();
            $table->foreign('receiver_identifier')->references($userRepo->getModel()->identifierKey())->on($userRepo->getTable())->cascadeOnUpdate()->nullOnDelete();

            $table->string('status')->index();
            $table->string('type')->index();
            $table->string('subject')->index();
            $table->string('title');
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
