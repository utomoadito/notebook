<template>
    <front-layout :canLogin="canLogin" :canRegister="canRegister" :categories="categories" :categoryId="category.id">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight pb-3 mb-5 border-b-2 border-gray-300">
            {{ category.name }}
        </h1>
        <p class="mb-7 text-lg">{{ category.description }}</p>
        <ul class="list-disc list-inside text-sm leading-relaxed">
            <li v-for="(note, index) in category.notes" :key="index">
                <inertia-link :href="`/category/${category.id}/note/${note.id}`">{{ note.name }}</inertia-link>
            </li>
        </ul>
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