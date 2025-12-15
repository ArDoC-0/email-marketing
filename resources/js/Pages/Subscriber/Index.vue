<script>
import Pagination from '../../Components/Pagination/Pagination.vue';

export default {
    components: {
        Pagination
    },
    props: {
        model: Array | Object
    },

    methods: {
        nextPage() {
            if (!this.model.subscribers.next_page_url) {
                return;
            };
            this.$inertia.get(this.model.subscribers.next_page_url)
        },

        prevPage() {
            if (!this.model.subscribers.prev_page_url) {
                return;
            }
            this.$inertia.get(this.model.subscribers.prev_page_url)
        }
    },

    created() {
        console.log(this.model.subscribers, this.model.count);
    }
}
</script>

<template>
    <Pagination 
    :total="this.model.count" 
    :current_page="this.subscribers.current_page" 
    @paginated-next="nextPage"
    @paginated-prev="prevPage"
    />
</template>