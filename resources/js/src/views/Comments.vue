<template>
    <div class="media-list media-bordered">
        <div v-for="comment in comments" :key="comment.id">
            <b-media v-if="comment.reply == null">
                <template #aside>
                    <b-img
                        :src="`/storage/users/${comment.user.pic}`"
                        blank-color="#ccc"
                        width="64"
                        alt="placeholder"
                        rounded="circle"
                    />
                </template>
                <h4 class="media-heading">{{ comment.user.name }}</h4>
                <p>
                    المنشور : <span>{{ comment.outlook.title }}</span> | الدولة
                    : <span>{{ comment.outlook.country }}</span> | تاريخ النشر :
                    <span>{{ comment.date }}</span>
                </p>
                <b-card-text>
                    <b style="font-weight: bold">التعليق : </b>
                    <p>{{ comment.comment }}</p>
                </b-card-text>
                <b-button
                    size="sm"
                    variant="outline-primary"
                    v-b-modal="`modal-reply-${comment.id}`"
                >
                    الردود علي التعليق
                </b-button>
                <b-modal
                    :id="`modal-reply-${comment.id}`"
                    centered
                    title="الردود علي التعليق"
                    hide-footer
                >
                    <b-card-text>
                        <div v-if="comment.reply !== null">
                            <b style="font-weight: bold">رد من الإدارة : </b>
                            <p>{{ comment.reply }}</p>
                        </div>
                        <b-form @submit.prevent="reply(comment.id)">
                            <b-form-group label="الرد" label-for="v-reply">
                                <b-form-textarea
                                    id="v-reply"
                                    placeholder="الرد"
                                    v-model="form.reply"
                                    required
                                />
                            </b-form-group>
                            <b-button type="submit" variant="primary">
                                الرد
                            </b-button>
                        </b-form>
                    </b-card-text>
                </b-modal>
            </b-media>
        </div>
    </div>
</template>
<script>
import {
    BMedia,
    BImg,
    BButton,
    BFormGroup,
    BFormTextarea,
    BCardText,
    BForm,
} from "bootstrap-vue";
import axios from "axios";
export default {
    components: {
        BMedia,
        BImg,
        BButton,
        BFormGroup,
        BFormTextarea,
        BCardText,
        BForm,
    },
    data() {
        return {
            comments: [],
            form: {
                reply: "",
            },
        };
    },
    async mounted() {
        try {
            let response = await axios.get("/api/comments");
            this.comments = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
    methods: {
        reply(id) {
            axios
                .post(
                    "/api/admin/add-reply",
                    {
                        comment_id: id,
                        reply: this.form.reply,
                    },
                    {
                        headers: {
                            token: JSON.parse(
                                localStorage.getItem("MatarAdmin")
                            ).token,
                        },
                    }
                )
                .then((res) => {
                    alert("تم اضافة الرد علي التعليق"), location.reload();
                })
                .catch((err) => {
                    alert("حدث خطأ ما");
                });
        },
    },
};
</script>
