<script>
export default {
    props: {
        model: required
    }
}
</script>

<template>
    <h2>Broadcast preview</h2>
    
    <header>
        <h2>
            {{ model.subject }}
        </h2>

        <div v-html="model.content" class="p-12">

        </div>
    </header>
</template>