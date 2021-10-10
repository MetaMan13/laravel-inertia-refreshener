<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>

        <div v-if="$page.props.flash.message" class="absolute bottom-10 right-10 px-6 py-2 bg-green-500 rounded-md">
            <p class="text-white">
                {{ $page.props.flash.message }}
            </p>
        </div>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 flex flex-column items-center justify-between">
                        <div>
                            Post Index
                        </div>
                        <div>
                            <Link :href="route('dashboard.post.create')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Create Post</Link>
                        </div>
                    </div>

                    <div v-for="post in posts" v-bind:key="post.id" class="p-6 bg-white border-b border-gray-200 flex flex-row justify-between">
                        <!-- Post Content -->
                        <div>
                            <div>
                                Post Title: <Link :href="route('dashboard.post.show', [post.id])" class="hover:text-blue-600 hover:underline">{{ post.title }}</Link>
                            </div>

                            <div>
                                <p>
                                    Post Body: {{ post.body }}
                                </p>
                            </div>
                        </div>

                        <!-- Post Crud Buttons -->
                        <div class="flex flex-row gap-4 items-start">
                            <Link :href="route('dashboard.post.edit', [post.id])" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Edit Post</Link>
                            <form @submit.prevent="deletePost(post)">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Delete Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import forms from '@tailwindcss/forms';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        posts: Object,
    },
    methods: {
        deletePost(post)
        {
            this.$inertia.delete('/dashboard/post/' + post.id, {_token: this.$page.csrf_token})
        }
    }
}
</script>
