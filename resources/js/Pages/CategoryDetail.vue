<template>
    <front-layout :canLogin="canLogin" :canRegister="canRegister" :categories="categories" :categoryId="category.id">
        {{ category.name }}
    </front-layout>
</template>

<script>
    import FrontLayout from '@/Layouts/FrontLayout.vue';
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            categories: Array,
            category: Object
        },
        components: { FrontLayout },
    }
</script>