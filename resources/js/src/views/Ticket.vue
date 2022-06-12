<template>
    <div>
        <div class="row">
            <div class="col-lg">
                <div style="font-size: 16px">
                    <span style="font-weight: bold"> رقم التذكرة : </span>
                    <span>{{ ticket.id }}</span>
                </div>
            </div>
            <div class="col-lg">
                <div style="font-size: 16px">
                    <span style="font-weight: bold"> حالة التذكرة : </span>
                    <b-badge variant="success" v-if="ticket.active == 1">
                        مفتوحة
                    </b-badge>
                    <b-badge variant="danger" v-else> مغلقة </b-badge>
                </div>
            </div>
        </div>
        <br />
        <div style="font-size: 16px">
            <span style="font-weight: bold"> عنوان التذكرة : </span>
            <span>{{ ticket.subject }}</span>
        </div>
        <br />
        <div style="font-size: 16px">
            <span style="font-weight: bold"> محتوي التذكرة : </span>
            <p>{{ ticket.content }}</p>
        </div>
    </div>
</template>
<script>
import { BBadge } from "bootstrap-vue";
import axios from "axios";
export default {
    components: {
        BBadge,
    },
    data() {
        return {
            ticket: [],
        };
    },
    async mounted() {
        try {
            let response = await axios.post(
                "/api/admin/tickets",
                { id: this.$route.params.id },
                {
                    headers: {
                        token: JSON.parse(localStorage.getItem("MatarAdmin"))
                            .token,
                    },
                }
            );
            this.ticket = response.data;
        } catch (err) {
            alert("حدث خطأ ما");
        }
    },
};
</script>
