<template>
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            <span class="d-none d-sm-inline-block">جميع الحقوق محفوظة</span>
            © {{ new Date().getFullYear() }}
            ادارة تطبيق مطر
        </span>
    </p>
</template>

<script>
import { BLink } from "bootstrap-vue";

export default {
    components: {
        BLink,
    },
};
</script>
