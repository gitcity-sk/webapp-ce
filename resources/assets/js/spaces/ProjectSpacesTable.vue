<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Issue</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
            <tbody>
                <space-row v-for="space in spaces.data" :space-data="space"></space-row>
            </tbody>
        </table>
    </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';
    import cssPreloader from '../vue/shared-components/css-preloader.vue';
    import spaceRow from './SpaceRow.vue'

    export default {
        components: {
            cssPreloader, spaceRow
        },
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['projectId'],
        data () {
            return {
                done: false,
                spaces: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/spaces')
            .then(response => {
                this.spaces = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>