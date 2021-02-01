<template>
    <div class="relative flex justify-center min-h-full sm:pt-0">
        <aside
            class="flex-1 transform top-0 left-0 bg-white fixed h-full overflow-auto ease-in-out transition-all duration-300 z-30"
            :class="isOpen ? ' md:w-1/6 sm:w-1/2' : 'w-0'"
        >
            <span
                @click="isOpen = true"
                class="flex w-full items-center p-4 border-b"
            >
                <h1 class="h-auto w-52 text-2xl font-serif font-bold tracking-wider mx-auto">
                    <inertia-link :href="'/'">NOTEBOOK</inertia-link>
                </h1>
            </span>
            <template v-for="(category, index) in categories">
                <inertia-link :key="index" :href="`/category/${category.id}`" 
                    class="flex items-center p-4 hover:bg-indigo-500 hover:text-white"
                    :class="categoryId == category.id ? 'bg-indigo-500 text-white':''"
                >
                    <span class="mr-2"></span>
                    <span>{{ category.name }}</span>
                </inertia-link>
            </template>
        </aside>
        <div class="flex-1 md:absolute ease-in-out transition-all duration-300 min-h-screen bg-gray-300" :class="isOpen ? 'md:w-5/6 md:right-0' : 'w-full md:-right-0'">
            <nav class="flex fixed top-0 w-full items-center justify-between px-6 h-16 bg-white text-gray-700 border-b border-gray-200 z-10">
                <div class="flex items-center">
                    <button class="mr-2" aria-label="Open Menu" @click="drawer">
                        <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        class="w-8 h-8"
                        >
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex fixed right-5 items-center">
                    <div v-if="canLogin" class="hidden md:block md:flex md:justify-between md:bg-transparent">
                        <button
                            v-if="$page.props.user"
                            title="Dashboard"
                            class="flex-1 items-center p-3 font-medium mr-2 text-center bg-gray-300 rounded  hover:bg-gray-400 focus:outline-none focus:bg-gray-400"
                        >
                            <inertia-link href="/dashboard">
                                Dashboard
                            </inertia-link>
                        </button>
                        <template v-else>
                            <button
                                title="Login"
                                class="flex-1 items-center p-3 font-medium mr-2 text-center bg-gray-300 rounded  hover:bg-gray-400 focus:outline-none focus:bg-gray-400"
                            >
                                <inertia-link :href="route('login')">
                                    Login
                                </inertia-link>
                            </button>
                            <button
                                title="Register"
                                v-if="canRegister"
                                class="flex-1 items-center p-3 font-medium mr-2 text-center bg-gray-300 rounded hover:bg-gray-400 focus:outline-none focus:bg-gray-400"
                            >
                                <inertia-link :href="route('register')">
                                    Register
                                </inertia-link>
                            </button>
                        </template>
                    </div>
                </div>
            </nav>
            <transition
                enter-class="opacity-0"
                enter-active-class="ease-out transition-medium"
                enter-to-class="opacity-100"
                leave-class="opacity-100"
                leave-active-class="ease-out transition-medium"
                leave-to-class="opacity-0"
            >
                <div
                    @keydown.esc="isOpen = false"
                    v-show="isOpen"
                    class="visible md:invisible z-10 fixed inset-0 transition-opacity"
                >
                    <div
                    @click="isOpen = false"
                    class="visible md:invisible absolute inset-0 bg-black opacity-50"
                    tabindex="0"
                    ></div>
                </div>
            </transition>
            <div class="flex max-w-6xl md:mx-auto py-32">
                <div class="flex flex-col p-6 sm bg-white shadow-xl w-full">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    export default {
        props: {
            canLogin: Boolean,
            // canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
            categories: Array,
            categoryId: Number
        },
        data: () => ({
            isOpen: true
        }),
        methods: {
            drawer() {
                this.isOpen = !this.isOpen;
            }
        },
        watch: {
            isOpen: {
                immediate: true,
                handler(isOpen) {
                    if (process.client) {
                        if (isOpen) document.body.style.setProperty("overflow", "hidden");
                        else document.body.style.removeProperty("overflow");
                    }
                }
            }
        },
        mounted() {
            document.addEventListener("keydown", e => {
                if (e.keyCode == 27 && this.isOpen) this.isOpen = false;
            });
        }
    }
</script>
