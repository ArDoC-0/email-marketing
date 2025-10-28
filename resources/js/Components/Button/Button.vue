<script>
export default {
    props: {
        type: {
            type: String,
            required: true
        }
    }
}
</script>

<template>
    <button type="{{ type }}" class="px-2 py-1 rounded-2xl shadow-2xl">
        <slot></slot>
    </button>
</template>