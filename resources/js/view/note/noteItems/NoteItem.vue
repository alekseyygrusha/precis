<template>
    <div class="note-item">
        <component :is="componentName" :itemData="itemData" :classes="setClasses"></component>
    </div>
</template>

<script>
import HeadingItem from "@/view/note/noteItems/HeadingItem.vue";
import TextItem from "@/view/note/noteItems/TextItem.vue";
export default {
    name: 'NoteItem',
    data() {
        return {

        };
    },
    components: {
        HeadingItem,TextItem
    },
    props: {
        itemData: {
            required: true,
            type: Object
        }
    },
    methods: {

    },
    computed: {
        componentName() {
            return `${this.itemData.type.charAt(0).toUpperCase() + this.itemData.type.slice(1)}Item`
        },
        setClasses() {
            return this.itemData?.defaultClasses.join(" ") + ' ' + this.itemData?.classes.join(" ");
        }

    },
    watch: {

    },
    created() {

    },
    mounted() {

    },
};
</script>

<style>

</style>
