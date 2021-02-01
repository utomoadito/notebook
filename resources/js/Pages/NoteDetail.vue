<template>
    <front-layout :canLogin="canLogin" :canRegister="canRegister" :categories="categories" :categoryId="note.category_id">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight pb-3 mb-5 border-b-2 border-gray-300">
            {{ note.name }}
        </h1>
        <p class="mb-7 text-lg"><span v-html="note.content"></span></p>
    </front-layout>
</template>

<script>
    import FrontLayout from '@/Layouts/FrontLayout.vue';
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            categories: Array,
            note: Object
        },
        components: { FrontLayout },
    }
</script>