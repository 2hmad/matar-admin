<template>
    <div>
        <b-form @submit.prevent="editAffiliate">
            <b-row>
                <b-col cols="12">
                    <b-form-group label="اسم المسوق" label-for="v-name">
                        <b-form-input
                            id="v-name"
                            v-model="form.name"
                            required
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="تاريخ انتهاء الكوبون"
                        label-for="v-expireDate"
                    >
                        <flat-pickr
                            class="form-control"
                            id="v-expireDate"
                            :config="{
                                dateFormat: 'Y-m-d',
                            }"
                            required
                            v-model="form.coupon_expire"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="عمولة التسجيل (بالدولار)"
                        label-for="v-register-commission"
                    >
                        <b-form-input
                            id="v-register-commission"
                            type="number"
                            step="0.00000001"
                            placeholder="$"
                            required
                            v-model="form.reg_commission"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="عمولة الاشتراك (بالدولار)"
                        label-for="v-subscribe-commission"
                    >
                        <b-form-input
                            id="v-subscribe-commission"
                            type="number"
                            step="0.00000001"
                            placeholder="$"
                            required
                            v-model="form.sub_commission"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="رقم الهاتف" label-for="v-phone">
                        <b-form-input id="v-phone" v-model="form.phone" />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="حساب الفيسبوك"
                        label-for="v-facebook_acc"
                    >
                        <b-form-input
                            id="v-facebook_acc"
                            v-model="form.facebook_acc"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="حساب تويتر" label-for="v-twitter_acc">
                        <b-form-input
                            id="v-twitter_acc"
                            v-model="form.twitter_acc"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="حساب انستجرام"
                        label-for="v-instagram_acc"
                    >
                        <b-form-input
                            id="v-instagram_acc"
                            v-model="form.instagram_acc"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="حساب تيك توك" label-for="v-tiktok_acc">
                        <b-form-input
                            id="v-tiktok_acc"
                            v-model="form.tiktok_acc"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group
                        label="حساب سناب شات"
                        label-for="v-snapchat_acc"
                    >
                        <b-form-input
                            id="v-snapchat_acc"
                            v-model="form.snapchat_acc"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-button type="submit" variant="primary" class="p-10">
                        حفظ التغييرات
                    </b-button>
                </b-col>
            </b-row>
        </b-form>
    </div>
</template>
<script>
import {
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BForm,
    BButton,
    BFormSelect,
    BFormSelectOption,
} from "bootstrap-vue";
import axios from "axios";
import flatPickr from "vue-flatpickr-component";
export default {
    components: {
        BRow,
        BCol,
        BFormGroup,
        BFormInput,
        BForm,
        BButton,
        BFormSelect,
        BFormSelectOption,
        flatPickr,
    },
    data() {
        return {
            countries: [],
            dateNtim: null,
            form: {
                id: this.$route.params.id,
                name: "",
                coupon_expire: "",
                reg_commission: null,
                sub_commission: null,
                phone: "",
                facebook_acc: "",
                twitter_acc: "",
                instagram_acc: "",
                tiktok_acc: "",
                snapchat_acc: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.post(
                `/api/admin/marketer/${this.$route.params.id}`,
                {},
                {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                }
            );
            this.form.name = response.data.full_name;
            this.form.coupon_expire = response.data.coupon_expire;
            this.form.reg_commission = response.data.reg_commission;
            this.form.sub_commission = response.data.sub_commission;
            this.form.phone = response.data.phone;
            this.form.facebook_acc = response.data.facebook_acc;
            this.form.twitter_acc = response.data.twitter_acc;
            this.form.instagram_acc = response.data.instagram_acc;
            this.form.tiktok_acc = response.data.tiktok_acc;
            this.form.snapchat_acc = response.data.snapchat_acc;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        editAffiliate() {
            const config = {
                headers: {
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/edit-marketer", this.form, config)
                .then((result) => {
                    alert("تم تعديل بيانات المسوق"), location.reload();
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
    },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
