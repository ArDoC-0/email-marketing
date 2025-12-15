<script>
export default {
    name: 'PerformanceLine',
    props: {
        performance: {
        type: Object,
        required: true
    }}
}
</script>

<template>
    <div class="flex text-sm text-gray-900">
        {{ performance.total}} 
        Recipients <span class="rounded-full bg-gray-700 block"></span>
        {{ performance.click_rate }}
        Click Rate <span class="rounded-full bg-gray-700 block"></span>
        {{ performance.open_rate }}
        Open Rate <span class="rounded-full bg-gray-700 block"></span>
    </div>
</template>