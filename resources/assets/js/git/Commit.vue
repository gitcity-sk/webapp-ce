<template>
<span v-if="done">
    <td class="has-emoji" style="max-width: 320px">
        <strong>{{ commit.data.author.name }}</strong> {{ commit.data.message }}
    </td>
    <td class="has-emoji">
        {{ commit.data.created_at.date | moment }}
    </td>
</span>
</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'

    export default {
        props: ['projectId', 'commitSha'],
        mounted () {
            console.log('Component TreeTableComponent mounted.')
        },
        data () {
            return {
                done: false,
                commit: null,
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/commits/' + this.commitSha)
            .then(response => {
                this.commit = response.data

                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>