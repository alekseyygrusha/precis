<template>
    <div class="note-item" :class="classes">
        <p>{{itemData.content.heading}}</p>
        <ul>
            <li v-for="item in itemData.content.list" v-html="item"></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'ListItem',
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
