import { mount } from '@vue/test-utils';
import { describe, it, expect } from 'vitest'
import Index from "@/Pages/Post/Index.vue";

describe('Post.Index', () => {
    it('renders posts correctly', async () => {
        const mockPosts = [
            { id: 1, title: 'Post 1', content: 'Content 1', date: '2024-03-06' },
            { id: 2, title: 'Post 2', content: 'Content 2', date: '2024-03-07' }
        ];

        const wrapper = mount(Index, {
            props: {
                posts: mockPosts,
                pagination: {
                    current_page: 1,
                    last_page: 1,
                    next_page_url: null,
                    prev_page_url: null
                }
            }
        });

        // Wait for the DOM to update
        await wrapper.vm.$nextTick();

        // Check if posts are rendered
        const postElements = wrapper.findAll('.post-item');
        expect(postElements.length).toBe(2); // Assuming each post has a class of 'post-item'

        // Check if pagination is rendered
        const paginationElement = wrapper.find('.pagination');
        expect(paginationElement.exists()).toBe(false);
    });
});
