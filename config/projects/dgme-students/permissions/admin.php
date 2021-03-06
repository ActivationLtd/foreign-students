<?php
/*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
| Comment the permissions that are not required
|
*/
return [

    /* Section: Module groups */
    'app-settings' => 1,
    'foreign-students' => 1,
    // 'accounting' => 1,
    // 'user-setting' => 1,

    /*------------------------------------------------------------------------
    | Section  Modules
    |------------------------------------------------------------------------*/

    /* Section : changes */
    'changes' => 1,
    'changes-view-any' => 1,
    'changes-view' => 1,
    'changes-create' => 1,
    'changes-update' => 1,
    'changes-delete' => 1,
    'changes-view-change-log' => 1,
    'changes-view-report' => 1,

    /* Section : comments */
    'comments' => 0,
    'comments-view-any' => 0,
    'comments-view' => 1,
    'comments-create' => 1,
    'comments-update' => 1,
    'comments-delete' => 1,
    'comments-view-change-log' => 1,
    'comments-view-report' => 1,

    /* Section : contents */
    'contents' => 0,
    'contents-view-any' => 0,
    'contents-view' => 1,
    'contents-create' => 1,
    'contents-update' => 1,
    'contents-delete' => 1,
    'contents-view-change-log' => 1,
    'contents-view-report' => 1,

    /* Section : countries */
    'countries' => 1,
    'countries-view-any' => 1,
    'countries-view' => 1,
    'countries-create' => 1,
    'countries-update' => 1,
    'countries-delete' => 1,
    'countries-view-change-log' => 1,
    'countries-view-report' => 1,

    /* Section : groups */
    'groups' => 1,
    'groups-view-any' => 1,
    'groups-view' => 1,
    'groups-create' => 1,
    'groups-update' => 1,
    'groups-delete' => 1,
    'groups-view-change-log' => 1,
    'groups-view-report' => 1,

    /* Section : in-app-notifications */
    'in-app-notifications' => 0,
    'in-app-notifications-view-any' => 0,
    'in-app-notifications-view' => 1,
    'in-app-notifications-create' => 1,
    'in-app-notifications-update' => 1,
    'in-app-notifications-delete' => 1,
    'in-app-notifications-view-change-log' => 1,
    'in-app-notifications-view-report' => 1,

    /* Section : module-groups */
    'module-groups' => 1,
    'module-groups-view-any' => 1,
    'module-groups-view' => 1,
    'module-groups-create' => 1,
    'module-groups-update' => 1,
    'module-groups-delete' => 1,
    'module-groups-view-change-log' => 1,
    'module-groups-view-report' => 1,

    /* Section : modules */
    'modules' => 1,
    'modules-view-any' => 1,
    'modules-view' => 1,
    'modules-create' => 1,
    'modules-update' => 1,
    'modules-delete' => 1,
    'modules-view-change-log' => 1,
    'modules-view-report' => 1,

    /* Section : notifications */
    'notifications' => 0,
    'notifications-view-any' => 0,
    'notifications-view' => 1,
    'notifications-create' => 1,
    'notifications-update' => 1,
    'notifications-delete' => 1,
    'notifications-view-change-log' => 1,
    'notifications-view-report' => 1,

    /* Section : packages */
    'packages' => 0,
    'packages-view-any' => 0,
    'packages-view' => 1,
    'packages-create' => 1,
    'packages-update' => 1,
    'packages-delete' => 1,
    'packages-view-change-log' => 1,
    'packages-view-report' => 1,

    /* Section : projects */
    'projects' => 0,
    'projects-view-any' => 0,
    'projects-view' => 1,
    'projects-create' => 1,
    'projects-update' => 1,
    'projects-delete' => 1,
    'projects-view-change-log' => 1,
    'projects-view-report' => 1,

    /* Section : push-notifications */
    'push-notifications' => 0,
    'push-notifications-view-any' => 0,
    'push-notifications-view' => 1,
    'push-notifications-create' => 1,
    'push-notifications-update' => 1,
    'push-notifications-delete' => 1,
    'push-notifications-view-change-log' => 1,
    'push-notifications-view-report' => 1,

    /* Section : reports */
    'reports' => 1,
    'reports-view-any' => 1,
    'reports-view' => 1,
    'reports-create' => 1,
    'reports-update' => 1,
    'reports-delete' => 1,
    'reports-view-change-log' => 1,
    'reports-view-report' => 1,

    /* Section : settings */
    'settings' => 0,
    'settings-view-any' => 0,
    'settings-view' => 1,
    'settings-create' => 1,
    'settings-update' => 1,
    'settings-delete' => 1,
    'settings-view-change-log' => 1,
    'settings-view-report' => 1,

    /* Section : spreads */
    'spreads' => 0,
    'spreads-view-any' => 0,
    'spreads-view' => 1,
    'spreads-create' => 1,
    'spreads-update' => 1,
    'spreads-delete' => 1,
    'spreads-view-change-log' => 1,
    'spreads-view-report' => 1,

    /* Section : subscriptions */
    'subscriptions' => 0,
    'subscriptions-view-any' => 0,
    'subscriptions-view' => 1,
    'subscriptions-create' => 1,
    'subscriptions-update' => 1,
    'subscriptions-delete' => 1,
    'subscriptions-view-change-log' => 1,
    'subscriptions-view-report' => 1,

    /* Section : tenants */
    'tenants' => 0,
    'tenants-view-any' => 0,
    'tenants-view' => 1,
    'tenants-create' => 1,
    'tenants-update' => 1,
    'tenants-delete' => 1,
    'tenants-view-change-log' => 1,
    'tenants-view-report' => 1,

    /* Section : uploads */
    'uploads' => 1,
    'uploads-view-any' => 1,
    'uploads-view' => 1,
    'uploads-create' => 1,
    'uploads-update' => 1,
    'uploads-delete' => 1,
    'uploads-view-change-log' => 1,
    'uploads-view-report' => 1,

    /* Section : users */
    'users' => 1,
    'users-view-any' => 1,
    'users-view' => 1,
    'users-create' => 1,
    'users-update' => 1,
    'users-delete' => 1,
    'users-view-change-log' => 1,
    'users-view-report' => 1,

    /* Todo: add new modules here  */
    /* Section : foreign-student-applications */
    'foreign-student-applications' => 1,
    'foreign-student-applications-view-any' => 1,
    'foreign-student-applications-view' => 1,
    'foreign-student-applications-create' => 1,
    'foreign-student-applications-update' => 1,
    'foreign-student-applications-delete' => 1,
    'foreign-student-applications-view-change-log' => 0,
    'foreign-student-applications-view-report' => 1,

    /* Section : foreign-application-examinations */
    'foreign-application-examinations' => 1,
    'foreign-application-examinations-view-any' => 1,
    'foreign-application-examinations-view' => 1,
    'foreign-application-examinations-create' => 1,
    'foreign-application-examinations-update' => 1,
    'foreign-application-examinations-delete' => 1,
    'foreign-application-examinations-view-change-log' => 0,
    'foreign-application-examinations-view-report' => 1,

    /* Section : foreign-app-lang-proficiencies */
    'foreign-app-lang-proficiencies' => 1,
    'foreign-app-lang-proficiencies-view-any' => 1,
    'foreign-app-lang-proficiencies-view' => 1,
    'foreign-app-lang-proficiencies-create' => 1,
    'foreign-app-lang-proficiencies-update' => 1,
    'foreign-app-lang-proficiencies-delete' => 1,
    'foreign-app-lang-proficiencies-view-change-log' => 0,
    'foreign-app-lang-proficiencies-view-report' => 1,

    /* Section : foreign-app-lang-proficiencies */
    'foreign-application-courses' => 1,
    'foreign-application-courses-view-any' => 1,
    'foreign-application-courses-view' => 1,
    'foreign-application-courses-create' => 1,
    'foreign-application-courses-update' => 1,
    'foreign-application-courses-delete' => 1,
    'foreign-application-courses-view-change-log' => 0,
    'foreign-application-courses-view-report' => 1,

    /* Section : application-sessions */
    'application-sessions' => 1,
    'application-sessions-view-any' => 1,
    'application-sessions-view' => 1,
    'application-sessions-create' => 1,
    'application-sessions-update' => 1,
    'application-sessions-delete' => 1,
    'application-sessions-view-change-log' => 0,
    'application-sessions-view-report' => 1,
];
