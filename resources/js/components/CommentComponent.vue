<template>

	<div>

		<!--		//Show Comment-->

		<div class="scrollbar-secondary thin overflow-auto" style="width: 100%; margin-left: 0; max-height: 350px;">
			<div>
				<div class="ml-5" v-if="Number(count)>2 && !url.includes('/post/'+PostId)">
					<a class="text-decoration-none text-muted" :href=" '/post/'+ PostId">see all comments....</a>
				</div>
				<div class="d-flex align-items-center mt-3 pl-3 pr-3 mb-2" v-for="get_comment in get_comments">
					<div>
						<a class="text-decoration-none"
						   :href=" '/profile/' + get_comment.user.id">
							<div class="mr-2">
								<div class="overflow-hidden d-flex justify-content-center align-items-center position-relative img-wrapper">

									<img v-if="get_comment.user.profile.profile_img"
									     :src="'/storage/' + get_comment.user.profile.profile_img" alt="img" class="img">
									<img v-if="!get_comment.user.profile.profile_img"
									     :src="'/storage/profile_imgs/default-avatar.png'" alt="img" class="img">
									<div class="d-flex justify-content-center align-items-center position-absolute img-border">
									</div>
								</div>
							</div>
						</a>
					</div>
					<div>
						<div class=" pr-4 pl-3 pb-1" style="background-color: rgba(0,0,0,0.05); border-radius: 15px;">
							<a :href="'/profile/' + get_comment.user.id" class="text-decoration-none lead" style="font-size: 18px;">
								{{get_comment.user.user_name}}
							</a>
							<div class="p-0 m-0">{{get_comment.comment}}</div>
						</div>

					</div>
					<div v-if="Number(UserId) === get_comment.user_id" class="ml-2">
						<button class="button btn btn-outline-primary" type="button" @click="delete_cmnt(get_comment.id)">
							<i class="far fa-trash-alt"></i>
						</button>
					</div>

				</div>
			</div>
		</div>

		<!--		//new Comment-->

<!--		<div>-->
<!--			<div class="d-flex align-items-center mt-3 pl-3 pr-3 mb-2" v-if="n_comment">-->
<!--				<div>-->
<!--					<a class="text-decoration-none"-->
<!--					   :href=" '/profile/' + UserId">-->
<!--						<div class="mr-2">-->
<!--							<div class="overflow-hidden d-flex justify-content-center align-items-center position-relative img-wrapper">-->
<!--								-->
<!--								<img :src="'/storage/' + UserImg" alt="img" class="img">-->
<!--								<div class="d-flex justify-content-center align-items-center position-absolute img-border">-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</a>-->
<!--				</div>-->
<!--				<div>-->
<!--					<div class=" pr-4 pl-3 pb-1" style="background-color: rgba(0,0,0,0.05); border-radius: 15px;">-->
<!--						<a :href="'/profile/' + UserId" class="text-decoration-none lead" style="font-size: 18px;">-->
<!--							{{UserName}}-->
<!--						</a>-->
<!--						<div class="p-0 m-0">{{n_comment}}</div>-->
<!--					-->
<!--					</div>-->
<!--				-->
<!--				</div>-->
<!--				<div class="ml-2">-->
<!--					<button class="button btn btn-outline-primary" type="button" @click="delete_cmnt(get_comment.id)">-->
<!--						<i class="far fa-trash-alt"></i>-->
<!--					</button>-->
<!--				</div>-->
<!--			</div>-->
<!--		-->
<!--		</div>-->

		<!--		//store Comment-->
		<div class="border-bottom">
		<form action="" @submit.prevent="submit">
			<div class="input-group mb-2 p-3 pt-4 ">
				<div class="mr-2">
					<div class="float-right overflow-hidden d-flex justify-content-center align-items-center position-relative img-wrapper">

						<img :src="'/storage/' + UserImg" alt="img" class="img">
						<div class="d-flex justify-content-center align-items-center position-absolute img-border">
						</div>
					</div>
				</div>
				<input type="text" class="form-control border-0 input"
				       placeholder="Add a Comment..." v-model="comment">
				<div class="input-group-append pl-2">
					<button class="btn button"
					        :class="comment ? 'btn-outline-primary' : 'btn-outline-secondary'"
					        :disabled="!comment" type="submit">
						<i class="far fa-paper-plane fa-1x"></i>
					</button>
					<input type="hidden" name="_token" :value="csrf">
				</div>
				<span class="invalid-feedback" role="alert">
					<strong></strong>
				</span>
			</div>
		</form>
		</div>
	</div>

</template>

<script>

    export default {

        mounted() {
			Event.$on('cmtCreated', () => {
                this.getCmnt();
			});
            Event.$on('cmtDeleted', () => {
                this.getCmnt();
            });
            this.getCmnt();
        },
        props: ['PostId', 'UserImg', 'UserName', 'UserId', 'url'],


        data() {
            return {
                comment: '',
                get_comments: [],
                n_comment: '',
	            count: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

            }
        },
        methods: {
            submit() {
                axios.post('/post/' + this.PostId + '/comment', {comment: this.comment})
                    .then(response => {
                        this.comment = '';
                        Event.$emit('cmtCreated');
                    })
            },
            getCmnt() {
                if (this.url.includes('/post/'+this.PostId)){
                    axios.get('/comment/' + this.PostId)
                        .then(response => {
                            this.get_comments = response.data.comments;
                            this.get_comments = this.get_comments.reverse();
                        })
                } else {
                    axios.get('/post/comment/' + this.PostId)
                        .then(response => {
                            this.get_comments = response.data.comments;
                            this.get_comments = this.get_comments.reverse();
                            this.count= response.data.commentsCount;
                        })
                }
            },
            delete_cmnt(index) {
                axios.delete('/post/comment/delete/' + index)
                    .then(response => {
                        Event.$emit('cmtDeleted');
                    })
            },
        }
    }
</script>
<style scoped>
	.button {
		border: none;
		border-radius: 10px !important;
		background-color: rgba(0, 0, 0, 0.09);
	}

	.button:hover {
		background-color: rgb(34, 156, 241)
	}

	.button:disabled {
		background-color: rgba(0, 0, 0, 0.09);
	}

	.input {
		height: 40px;
		background-color: rgba(0, 0, 0, 0.07) !important;
		border-radius: 20px !important;
	}

	.img {
		height: 100% !important;
		width: auto !important;
	}

	.img-wrapper {
		height: 38px;
		width: 38px;
		border: 1.5px solid rgba(0, 0, 0, 0.77);
		border-radius: 50%;
		background-color: rgba(255, 255, 0, 0)
	}

	.img-border {
		height: 36px;
		width: 36px;
		border: 2px solid #ffffff;
		border-radius: 50%;
	}


</style>
