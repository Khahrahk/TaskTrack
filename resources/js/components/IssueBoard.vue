<template>
    <div class="row">
        <div v-for="status in statuses" :key="status.id">
            {{ status.name }}
                    <draggable
                        class="list-group"
                        :list="status.name"
                        group="people"
                        @change="log"
                        itemKey="name">
                        <template #item="{ element, index }">
                            <div class="list-group-item">{{ element.name }} {{ index }}</div>
                        </template>
                    </draggable>
            <rawDisplayer class="col-3" :value="status.name" title="{{ status.name }}" />

            <!--            <div class="col-3">-->
<!--                <draggable-->
<!--                    class="list-group"-->
<!--                    :list="status.name"-->
<!--                    group="people"-->
<!--                    @change="log"-->
<!--                    itemKey="name"-->
<!--                >-->
<!--                    <template #item="{ element, index }">-->
<!--                        <div class="list-group-item">{{ element.name }} {{ index }}</div>-->
<!--                    </template>-->
<!--                </draggable>-->
<!--            </div>-->

        </div>
    </div>
</template>
<script>
import draggable from "vuedraggable";

export default {
    name: "two-lists",
    display: "Two Lists",
    order: 1,

    components: {
        draggable
    },
    props: ['statuses'],
    // data() {
    //     return {
    //         statuses: [],
    //     };
    // },
    methods: {
        add: function() {
            this.list.push({ name: "Juan" });
        },
        replace: function() {
            this.list = [{ name: "Edgard" }];
        },
        clone: function(el) {
            return {
                name: el.name + " cloned"
            };
        },
        log: function(evt) {
            window.console.log(evt);
        }
    }
};
</script>
