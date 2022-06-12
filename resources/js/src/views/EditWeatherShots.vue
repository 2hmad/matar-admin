<template>
    <div>
        <b-form @submit.prevent="editShot">
            <b-row>
                <b-col cols="12">
                    <b-form-group label="اسم المصور" label-for="v-photographer">
                        <b-form-input
                            id="v-photographer"
                            placeholder="اسم المصور"
                            v-model="form.photographer"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="الموقع" label-for="v-location">
                        <b-form-input
                            id="v-location"
                            placeholder="الموقع"
                            v-model="form.location"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="التاريخ والوقت" label-for="v-date">
                        <flat-pickr
                            class="form-control"
                            id="v-date"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.date"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group
                        label="جدولة المنشور"
                        label-for="v-publishDate"
                    >
                        <flat-pickr
                            class="form-control"
                            id="v-publishDate"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.publishDate"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-form-group label="تاريخ الاختفاء" label-for="v-hideDate">
                        <flat-pickr
                            class="form-control"
                            id="v-hideDate"
                            :config="{
                                enableTime: true,
                                dateFormat: 'Y-m-d H:i:s',
                            }"
                            v-model="form.hideDate"
                        />
                    </b-form-group>
                </b-col>

                <b-col cols="12">
                    <b-button type="submit" variant="primary" class="mr-1">
                        تعديل
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
    BFormCheckbox,
    BForm,
    BButton,
    BFormSelect,
    BFormTextarea,
    BFormFile,
    BFormSelectOption,
} from "bootstrap-vue";
import flatPickr from "vue-flatpickr-component";
import axios from "axios";
export default {
    components: {
        BRow,
        BCol,
        BFormGroup,
        BFormInput,
        BFormCheckbox,
        BForm,
        BButton,
        BFormSelect,
        BFormTextarea,
        flatPickr,
        BFormFile,
        BFormSelectOption,
    },
    data() {
        return {
            form: {
                id: this.$route.params.id,
                photographer: "",
                location: "",
                date: "",
                publishDate: "",
                hideDate: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get(
                `/api/weather-shot/${this.$route.params.id}`
            );
            this.form.photographer = response.data.photographer;
            this.form.location = response.data.location;
            this.form.date = response.data.date;
            this.form.publishDate = response.data.schedule;
            this.form.hideDate = response.data.hide;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        editShot() {
            const config = {
                headers: {
                    token: JSON.parse(localStorage.getItem("MatarAdmin")).token,
                },
            };
            axios
                .post("/api/admin/edit-weathershot", this.form, config)
                .then((result) => {
                    alert("تم تعديل التوقع"), location.reload();
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
