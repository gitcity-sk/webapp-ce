<template>
    <div class="mb-3 border-bottom">
        <div class="d-flex flex-row">
            <div><p class="h6">Labels</p></div>
            <div class="ml-auto"><labels-dropdown :issue-id="issueId" :parent-labels="labels.data"></labels-dropdown></div>
        </div>
        <div class="mb-1">
            <span v-if="done" v-for="label in labels.data" :class="'badge ' + label.color + ' mr-1'">{{ label.text }}</span>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import labelsDropdown from '../labels/LabelDropdown.vue'

export default {
    components: { labelsDropdown },
    props: ['issueId', 'redirect'],
    data () {
        return {
            done: false,
            labels: {
                data: []
            },
            errors: []
        }
    },
    created () {
        axios.get('/api/issues/' + this.issueId + '/labels')
        .then(response => {
            this.labels = response.data;
            this.done = true
        })
        .catch(e => {
            this.errors.push(e)
        })
    },

    mounted() {
        this.$on('badgesUpdated', function () {
            this.onBadgesUpdated()
        })
    },

    methods: {
        onBadgesUpdated: function () {
            axios.get('/api/issues/' + this.issueId + '/labels')
            .then(response => {
                this.labels = response.data;
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
}
</script>