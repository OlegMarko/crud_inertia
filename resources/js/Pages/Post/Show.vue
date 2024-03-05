<script setup>

import { Link, router, usePage } from "@inertiajs/vue3";
import PostLayout from "@/Layouts/PostLayout.vue";

const { post } = defineProps({ post: Object });

const deletePost = () => {
    router.delete(`/posts/${post.id}`);
};

</script>

<template>
    <PostLayout>
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Post</h1>
        <div class="mb-4">
            <Link
                :href="route('post.index')"
                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-2 px-4 rounded inline-flex items-center"
            >
                Back
            </Link>
        </div>
        <div v-if="post">
            <div class="text-xl font-semibold mb-2 border-t border-gray-400 dark:text-white dark:border-gray-100">
                <div class="text-lg font-semibold mb-2 dark:text-white">{{ post.title }}</div>
                <div class="text-gray-600 mb-4 dark:text-gray-100">{{ post.content }}</div>

                <div class="flex justify-between items-center">
                    <div>
                        <Link
                            :href="route('post.edit', post.id)"
                            class="bg-gray-200 dark:bg-gray-700 hover:bg-blue-300 dark:hover:bg-blue-600 text-gray-800 dark:text-gray-200 font-semibold py-1 px-2 rounded inline-flex items-center"
                        >
                            Edit
                        </Link>
                    </div>
                    <div>
                        <span
                            @click="deletePost"
                            class="cursor-pointer bg-gray-200 dark:bg-gray-700 hover:bg-red-300 dark:hover:bg-red-600 text-gray-800 dark:text-gray-200 font-semibold py-1 px-2 rounded inline-flex items-center"
                        >
                            Delete
                        </span>
                    </div>
                    <div class="text-right text-gray-500 text-sm dark:text-gray-300">{{ post.date }}</div>
                </div>
            </div>
        </div>
    </PostLayout>
</template>
