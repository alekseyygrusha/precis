<template>
    <div class="note-item">
        <p :class="classes" v-html="itemData.content"></p>
    </div>
</template>

<script>
export default {
    name: 'TextItem',
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
