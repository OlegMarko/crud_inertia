<script setup>

import { reactive } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import PostLayout from "@/Layouts/PostLayout.vue";

const { errors } = defineProps({ errors: Object });

const form = reactive({
    title: null,
    content: null
});

function submit() {
    router.post('/posts', form);
}

</script>

<template>
    <PostLayout>
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Create Post</h1>
        <div class="mb-4">
            <Link
                :href="route('post.index')"
                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-2 px-4 rounded inline-flex items-center"
            >
                Back
            </Link>
        </div>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <input
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="text"
                    placeholder="Title"
                    v-model="form.title">
                <div v-if="errors.title">
                    <p class="text-sm text-red-500">{{ errors.title }}</p>
                </div>
            </div>
            <div class="mb-4">
                <textarea
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="5"
                    placeholder="Content"
                    v-model="form.content">
                </textarea>
                <div v-if="errors.content">
                    <p class="text-sm text-red-500">{{ errors.content }}</p>
                </div>
            </div>
            <div>
                <button
                    class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-2 px-4 rounded inline-flex items-center"
                    type="submit"
                >
                    Store
                </button>
            </div>
        </form>
    </PostLayout>
</template>
