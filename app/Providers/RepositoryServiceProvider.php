<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\EmailVerificationRepositoryInterface;
use App\Repositories\EmailVerificationRepository;
use App\Repositories\Contracts\GovernmentAgencyRepositoryInterface;
use App\Repositories\GovernmentAgencyRepository;
use App\Repositories\Contracts\GovernmentAgencySectionRepositoryInterface;
use App\Repositories\GovernmentAgencySectionRepository;
use App\Repositories\Contracts\ComplaintRepositoryInterface;
use App\Repositories\ComplaintRepository;
use App\Repositories\Contracts\ComplaintResponseRepositoryInterface;
use App\Repositories\ComplaintResponseRepository;
use App\Repositories\Contracts\ComplaintStatusRepositoryInterface;
use App\Repositories\ComplaintStatusRepository;
use App\Repositories\Contracts\GovernmentAgencyEmployeeRepositoryInterface;
use App\Repositories\GovernmentAgencyEmployeeRepository;
use App\Repositories\Contracts\GovernmentAgencyEmploymentTypeRepositoryInterface;
use App\Repositories\GovernmentAgencyEmploymentTypeRepository;
use App\Repositories\Contracts\GovernmentAgencySectionServiceRepositoryInterface;
use App\Repositories\GovernmentAgencySectionServiceRepository;
use App\Repositories\Contracts\MediaRepositoryInterface;
use App\Repositories\MediaRepository;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Repositories\NotificationRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EmailVerificationRepositoryInterface::class, EmailVerificationRepository::class);
        $this->app->bind(GovernmentAgencyRepositoryInterface::class, GovernmentAgencyRepository::class);
        $this->app->bind(GovernmentAgencySectionRepositoryInterface::class, GovernmentAgencySectionRepository::class);
        $this->app->bind(ComplaintRepositoryInterface::class, ComplaintRepository::class);
        $this->app->bind(ComplaintResponseRepositoryInterface::class, ComplaintResponseRepository::class);
        $this->app->bind(ComplaintStatusRepositoryInterface::class, ComplaintStatusRepository::class);
        $this->app->bind(GovernmentAgencyEmployeeRepositoryInterface::class, GovernmentAgencyEmployeeRepository::class);
        $this->app->bind(GovernmentAgencyEmploymentTypeRepositoryInterface::class, GovernmentAgencyEmploymentTypeRepository::class);
        $this->app->bind(GovernmentAgencySectionServiceRepositoryInterface::class, GovernmentAgencySectionServiceRepository::class);
        $this->app->bind(MediaRepositoryInterface::class, MediaRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);

    }

    public function boot()
    {
        //
    }
}
