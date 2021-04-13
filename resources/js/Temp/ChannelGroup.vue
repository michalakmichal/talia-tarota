<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        {{message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data()
        {
            return {
                message: null
            };
        },
        mounted() {
            console.log('Component mounted.');
            window.Echo.channel('channel')
            .listen('hello', (e) => {
            this.message = e.data;
            });
        }
    }
</script>
