<template>
    <div class="note-item">
        <div :class="classes" v-html="itemData.content">

        </div>
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
