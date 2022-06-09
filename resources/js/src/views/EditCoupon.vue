<template>
    <div>
        <b-form @submit.prevent="editCoupon">
            <b-row>
                <b-col cols="12">
                    <b-form-group label="الكوبون" label-for="v-title">
                        <b-form-input
                            id="v-title"
                            placeholder="الكوبون"
                            v-model="form.coupon"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="الدولة" label-for="v-country">
                        <b-form-select id="v-country" v-model="form.country">
                            <b-form-select-option
                                :value="form.country"
                                selected
                                hidden
                            >
                                {{ form.country }}
                            </b-form-select-option>
                            <b-form-select-option
                                v-for="country in countries"
                                :key="country.id"
                            >
                                {{ country.country }}
                            </b-form-select-option>
                        </b-form-select>
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="مدة الانتهاء" label-for="v-date">
                        <flat-pickr
                            class="form-control"
                            id="v-date"
                            :config="{
                                dateFormat: 'Y-m-d',
                            }"
                            v-model="form.expire_date"
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
                coupon: "",
                country: "",
                expire_date: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get(
                `/api/coupon/${this.$route.params.id}`
            );
            this.form.coupon = response.data.coupon;
            this.form.country = response.data.country;
            this.form.expire_date = response.data.expire_date;

            let countries = await axios.get("/api/countries");
            this.countries = countries.data;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        editCoupon() {
            const config = {
                headers: {
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/edit-coupon", this.form, config)
                .then((result) => {
                    alert("تم تعديل الكوبون"), location.reload();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-flatpicker.scss";
</style>
