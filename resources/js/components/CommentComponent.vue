<template>
	
	<div>
		<div>
			{{n_comment}}
		</div>
		<form action="" @submit.prevent="submit">
			
			<div class="input-group mb-3">
				<input type="text" class="form-control"
				       placeholder="Add a Comment..." v-model="comment" >
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit">
						<i class="far fa-paper-plane fa-1x"></i>
					</button>
					<input type="hidden" :value="csrf" name="_token" id="csrf-token">
				</div>
				
				<span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
				
			</div>
		</form>
		
<!--		<button @click="followUser" class="btn pl-2 pr-2 ml-4 mb-1 p-0"-->
<!--		        :class="status ? 'btn-outline-secondary' : 'btn-primary'" v-text="buttonText"></button>-->
	</div>

</template>

<script>
    import ShowComments from './ShowCommentsComponent';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
	    components: {ShowComments},
	    props: ['csrf', 'PostId'],
    
    
        data () {
            return {
                comment: '',
	            n_comment: '',
            }
        },
        methods: {
            submit(){
                axios.post('/post/' + this.PostId + '/comment', {comment:this.comment})
                    .then(response => {
                        this.n_comment = this.comment;
                        this.comment= '';
                        console.log(response.data)
                })
                    

            }
        }
    }
</script>