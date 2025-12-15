<script>

export default {
    props: {
        current_page: Number,
        total: Number,
    },
    emits: ['paginatedPrev', 'paginatedNext'],

    methods: {

    }
}

</script>

<template>
    <div>
        <div>
            Total: {{ total }}
        </div>
        <div>
            <button @click="$emit('paginatedPrev')" :disabled="current_page ==1">
                Prev
            </button>
            <button @click="$emit('paginatedNext')">
                Next
            </button>
        </div>
    </div>
</template>