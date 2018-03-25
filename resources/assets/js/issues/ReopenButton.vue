<template>
    <button v-on:click.prevent="closeItem" class="btn btn-outline-success">Reopen Issue</button>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted () {
            console.log('Component Reopen mounted.')
        },
        props: ['issueId', 'redirect'],
        data () {
            return {
                done: false,
                groups: {
                    data: []
                },
                errors: []
            }
        },
        methods: {
            closeItem: function() {
                console.log(this.url)

                axios.put('/api/issues/reopen', {
                    id: this.issueId
                })
                .then(response => {
                    window.location.href = this.redirect
                })
                .catch(e => {
                    this.errors.push(e)
                })
            }
        }
    }
</script>