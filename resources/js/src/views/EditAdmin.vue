<template>
    <div>
        <b-form @submit.prevent="editAdmin">
            <b-row>
                <b-col cols="12">
                    <b-form-group label="الاسم" label-for="v-title">
                        <b-form-input
                            id="v-title"
                            placeholder="الاسم"
                            required
                            v-model="form.name"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="البريد الالكتروني" label-for="v-email">
                        <b-form-input
                            id="v-email"
                            placeholder="البريد الالكتروني"
                            required
                            v-model="form.email"
                        />
                    </b-form-group>
                </b-col>
                <b-col cols="12">
                    <b-form-group label="الصلاحية" label-for="role">
                        <b-form-select id="role" v-model="form.role">
                            <option
                                v-if="form.role == '1'"
                                selected
                                hidden
                                :value="form.role"
                            >
                                ادمن
                            </option>
                            <option
                                v-if="form.role == '2'"
                                selected
                                hidden
                                :value="form.role"
                            >
                                مشرف
                            </option>
                            <option
                                v-if="form.role == '3'"
                                selected
                                hidden
                                :value="form.role"
                            >
                                مراقب
                            </option>
                            <option value="1">ادمن</option>
                            <option value="2">مشرف</option>
                            <option value="3">مراقب</option>
                        </b-form-select>
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
} from "bootstrap-vue";
import axios from "axios";
export default {
    components: {
        BRow,
        BCol,
        BFormGroup,
        BFormInput,
        BForm,
        BButton,
        BFormSelect,
    },
    data() {
        return {
            dateNtim: null,
            form: {
                id: this.$route.params.id,
                name: "",
                email: "",
                role: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.post(
                "/api/admin/get-admin",
                {
                    id: this.form.id,
                },
                {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                }
            );
            this.form.name = response.data.name;
            this.form.email = response.data.email;
            this.form.role = response.data.role;
        } catch (err) {
            console.log(err);
        }
    },
    methods: {
        editAdmin() {
            axios
                .post("/api/admin/edit-admin", this.form, {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                })
                .then((res) => {
                    alert("تم تعديل بيانات المستخدم");
                    location.reload();
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
    },
};
</script>
