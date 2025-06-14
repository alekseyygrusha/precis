<template>
    <div class="note-item">

        <div :class="classes">
            {{itemData.content}}
        </div>
    </div>
</template>

<script>
export default {
    name: 'HeadingItem',
    data() {
        return {

        };
    },
    props: {
        itemData: {
            required: true,
            type: Object
        },
        classes: {
            required: false,
            type: String
        }
    },
    methods: {

    },
    computed: {

    },
    watch: {

    },
    mounted() {

    },
};
</script>

<style>

</style>
