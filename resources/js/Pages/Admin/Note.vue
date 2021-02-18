<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Note
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="alert" class="relative py-3 pl-4 pr-10 leading-normal text-black-700 bg-green-100" role="alert">
                    <p>{{ $page.props.flash.message }}</p>
                    <span @click="alert = false" class="absolute inset-y-0 right-0 flex items-center mr-4">
                        <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    </span>
                </div>
                <div class="bg-white overflow-hidden shadow-xl">
                    <div class="flex flex-col justify-center p-6 sm bg-white">
                        <div class="mb-2">
                            <button 
                                @click="modal = true"
                                class="py-2 px-4 border border-transparent shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Create New
                            </button>
                        </div>
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow border-b border-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    No
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Category
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Created Date
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(note, index) in notes" :key="index">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ index+1 }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ note.name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ note.category.name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ dateTime(note.created_at) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <button @click="onEdit(note)" class="py-2 px-4 border border-transparent shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        Edit
                                                    </button>
                                                    <button @click="onDelete(note)" class="py-2 px-4 border border-transparent shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <transition
            enter-active-class="ease-out duration-300"
            enter-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="ease-in duration-200"
            leave-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="modal" class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <transition
                        enter-active-class="ease-out duration-300"
                        enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-active-class="ease-in duration-200"
                        leave-class="opacity-100 translate-y-0 sm:scale-100"
                        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    >
                        <div v-if="modal" class="inline-block align-bottom bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <form @submit.prevent="onSave" action="#" method="POST">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="flex flex-wrap -mx-2">
                                            <div class="w-full px-2 mb-5">
                                                <label class="block mb-1" for="formGridCode_card">Note Name</label>
                                                <input type="text" name="name" v-model="form.name" class="w-full h-10 px-3 text-base placeholder-gray-600 border focus:shadow-outline" required/>
                                            </div>
                                            <div class="w-full px-2 mb-5">
                                                <label class="block mb-1" for="formGridCode_card">Category</label>
                                                <select v-model="form.category_id" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border appearance-none focus:shadow-outline" required>
                                                    <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                                                </select>
                                            </div>
                                            <div class="w-full px-2 mb-5">
                                                <label class="block mb-1" for="formGridCode_card">Content</label>
                                                <!-- <textarea v-model="form.content" class="w-full h-16 px-3 py-2 text-base text-gray-700 placeholder-gray-600 border focus:shadow-outline" required>
                                                    Tells what your thinking
                                                </textarea> -->
                                                <ckeditor 
                                                    :editor="ckeditor.editor" 
                                                    v-model="form.content" 
                                                    :config="ckeditor.editorConfig"
                                                >
                                                    Tells what your thinking
                                                </ckeditor>
                                            </div>
                                        </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="w-full inline-flex justify-center border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Save
                                    </button>
                                    <button 
                                        @click="onCloseModal"
                                        type="button" 
                                        class="mt-3 w-full inline-flex justify-center border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </transition>
                </div>
            </div>
        </transition>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import moment from 'moment';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic'; 

    export default {
        props: {
            notes: Array,
            categories: Array
        },
        components: {
            AppLayout,
        },
        data: () => ({
            modal: false,
            alert: false,
            editMode: false,
            form: {},
            ckeditor: {
                editor: ClassicEditor,
                editorConfig: {
                    ckfinder: {
                        uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Files&responseType=json'
                    }
                }
            }
        }),
        methods: {
            dateTime(val) {
                return moment(val).format('DD-MM-YYYY HH:mm:ss');
            },
            onEdit(data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.modal = true;
            },
            onDelete(data) {
                if (!confirm('Are you sure want to delete this data?')) return;
                this.$inertia.delete('/note/' + data.id, {
                    onSuccess: () => {
                        this.form = {};
                        this.alert = true;
                    }
                });
            },
            onSave() {
                let method, url;
                if (this.editMode) {
                    method = 'put';
                    url = '/note/' + this.form.id;
                } else {
                    method = 'post';
                    url = '/note';
                }
                this.form._token = this.$page.props.csrf_token;
                this.$inertia[method](url, this.form, {
                    onSuccess: () => {
                        this.onCloseModal();
                        this.alert = true;
                    }
                });
            },
            onCloseModal() {
                this.modal = false;
                this.editMode = false;
                this.form = {};
            }
        }
    }
</script>
