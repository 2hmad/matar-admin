import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "/login",
            name: "login",
            component: () => import("@/views/Login.vue"),
            meta: {
                layout: "full",
                guest: true,
            },
        },
        {
            path: "/",
            name: "home",
            component: () => import("@/views/Home.vue"),
            meta: {
                pageTitle: "الرئيسية",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "الرئيسية",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/outlooks",
            name: "outlooks",
            component: () => import("@/views/Outlooks.vue"),
            meta: {
                pageTitle: "التوقعات ومتابعه الحالات",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "التوقعات ومتابعه الحالات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/comments",
            name: "comments",
            component: () => import("@/views/Comments.vue"),
            meta: {
                pageTitle: "التعليقات المنشورة",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "التعليقات المنشورة",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/add-outlook",
            name: "add-outlook",
            component: () => import("@/views/AddOutlook.vue"),
            meta: {
                pageTitle: "اضافة توقعات",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "اضافة توقعات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/edit-outlook/:id",
            name: "edit-outlook",
            component: () => import("@/views/EditOutlook.vue"),
            meta: {
                pageTitle: "تعديل المنشور",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "تعديل المنشور",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/weather-shots",
            name: "weather-shots",
            component: () => import("@/views/WeatherShots.vue"),
            meta: {
                pageTitle: "صور ومقاطع الطقس",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "صور ومقاطع الطقس",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/edit-shot/:id",
            name: "edit-shot",
            component: () => import("@/views/EditWeatherShots.vue"),
            meta: {
                pageTitle: "تعديل المشاركة",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "تعديل المشاركة",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/pending-shots",
            name: "pending-shots",
            component: () => import("@/views/PendingWeatherShots.vue"),
            meta: {
                pageTitle: "مراجعه صور ومقاطع الطقس",
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "مراجعه صور ومقاطع الطقس",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/notifications",
            name: "notifications",
            component: () => import("@/views/Notifications.vue"),
            meta: {
                pageTitle: "الاشعارات",
                requiresAuth: true,
                isPublisher: true,
                breadcrumb: [
                    {
                        text: "الاشعارات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/coupons",
            name: "coupons",
            component: () => import("@/views/Coupons.vue"),
            meta: {
                pageTitle: "الكوبونات",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "الكوبونات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/edit-coupon/:id",
            name: "edit-coupons",
            component: () => import("@/views/EditCoupon.vue"),
            meta: {
                pageTitle: "تعديل الكوبونات",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "تعديل الكوبونات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/affiliate",
            name: "affiliate",
            component: () => import("@/views/Affiliate.vue"),
            meta: {
                pageTitle: "المسوقين",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "المسوقين",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/edit-affiliate/:id",
            name: "edit-affiliate",
            component: () => import("@/views/EditAffiliate.vue"),
            meta: {
                pageTitle: "تعديل بيانات المسوق",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "تعديل بيانات المسوق",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/affiliate-preview/:id",
            name: "affiliate-preview",
            component: () => import("@/views/AffiliatePreview.vue"),
            meta: {
                pageTitle: "احصائيات المسوق",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "احصائيات المسوق",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/support-tickets",
            name: "support-tickets",
            component: () => import("@/views/SupportTickets.vue"),
            meta: {
                pageTitle: "الاقتراحات والشكاوي",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "الاقتراحات والشكاوي",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/ticket/:id",
            name: "ticket",
            component: () => import("@/views/Ticket.vue"),
            meta: {
                pageTitle: "تذكرة الدعم",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "تذكرة الدعم",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/ads",
            name: "ads",
            component: () => import("@/views/Ads.vue"),
            meta: {
                pageTitle: "الاعلانات",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "الاعلانات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/subscriptions",
            name: "subscriptions",
            component: () => import("@/views/Subscriptions.vue"),
            meta: {
                pageTitle: "ادارة الاشتراكات",
                isPublisher: true,
                requiresAuth: true,
                breadcrumb: [
                    {
                        text: "ادارة الاشتراكات",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/admins",
            name: "admins",
            component: () => import("@/views/Admins.vue"),
            meta: {
                pageTitle: "ادارة المستخدمين",
                requiresAuth: true,
                requireAdmin: true,
                breadcrumb: [
                    {
                        text: "ادارة المستخدمين",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/edit-admin/:id",
            name: "edit-admin",
            component: () => import("@/views/EditAdmin.vue"),
            meta: {
                pageTitle: "تعديل مستخدم",
                requiresAuth: true,
                requireAdmin: true,
                breadcrumb: [
                    {
                        text: "تعديل مستخدم",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/settings",
            name: "settings",
            component: () => import("@/views/Settings.vue"),
            meta: {
                pageTitle: "اعدادات النظام",
                requiresAuth: true,
                requireAdmin: true,
                breadcrumb: [
                    {
                        text: "اعدادات النظام",
                        active: true,
                    },
                ],
            },
        },
        {
            path: "/error-404",
            name: "error-404",
            component: () => import("@/views/error/Error404.vue"),
            meta: {
                layout: "full",
            },
        },
        {
            path: "/permission-denied",
            name: "permission-denied",
            component: () => import("@/views/error/PermissionDenied.vue"),
            meta: {
                layout: "full",
            },
        },
        {
            path: "*",
            redirect: "error-404",
        },
    ],
});

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById("loading-bg");
    if (appLoading) {
        appLoading.style.display = "none";
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.guest)) {
        if (store.getters.isAuthenticated) {
            next("/");
            return;
        }
        next();
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requireAdmin)) {
        if (JSON.parse(localStorage.getItem("MatarAdmin")).role === "1") {
            next();
            return;
        } else {
            location.href = "/permission-denied";
        }
        next();
    } else {
        next();
    }
});
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.isPublisher)) {
        if (JSON.parse(localStorage.getItem("MatarAdmin")).role !== "3") {
            next();
            return;
        } else {
            location.href = "/permission-denied";
        }
        next();
    } else {
        next();
    }
});
export default router;
