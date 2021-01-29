<template>
    <front-layout :canLogin="canLogin" :canRegister="canRegister" :categories="categories">
        Blabanika
    </front-layout>
</template>

<script>
    import FrontLayout from '@/Layouts/FrontLayout';
    
    export default {
        
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            categories: Array
        },
        components: {
            FrontLayout
        }
    }
</script>