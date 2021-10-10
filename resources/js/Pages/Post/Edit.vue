<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Post Edit
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">

                            <!-- Title -->
                            <div>
                                <label for="">Title</label>
                                <input v-model="post.title" type="text" name="title" placeholder="Please ente a post title">

                                <!-- Title errors -->
                                <div v-if="errors.title">
                                    <p class="text-sm text-red-600">
                                        {{ errors.title }}
                                    </p>
                                </div>
                            </div>

                            <!-- Body -->
                            <div>
                                <label for="">Body</label>
                                <textarea v-model="post.body" name="body" id="" cols="30" rows="10" placeholder="Please enter the post body"></textarea>

                                <!-- Body errors -->
                                <div v-if="errors.body">
                                    <p class="text-sm text-red-600">
                                        {{ errors.body }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <button type="submit">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from '@vue/reactivity';
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        post: Object,
        errors: Object,
    },
    methods: {
        submit() {
            this.$inertia.patch('/dashboard/post/' + this.post.id, this.post)
        },
    },
}
</script>
