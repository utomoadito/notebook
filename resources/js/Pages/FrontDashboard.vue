<template>
    <front-layout :canLogin="canLogin" :canRegister="canRegister" :categories="categories">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight pb-3 mb-5 border-b-2 border-gray-300">
            Personal Notes
        </h1>
        <p class="mb-7 text-lg">
            Ini adalah aplikasi yang mana digunakan untuk mencatat sesuatu hal yang penting dan berguna bagi saya sendiri atau mungkin khalayak umum. 
            Dengan ini, saya bisa mengingat hal-hal penting yang telah saya catat dan juga dapat membantu menambah serta membandingkan literasi pengetahuan yang ada.
            <br><br>
            This is an application which is used to note something important and useful for myself or perhaps the general public. 
            With this, I can remember important things that I have noted and can also help increase and compare existing knowledge literacy.
        </p>
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