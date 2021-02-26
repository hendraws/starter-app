@inlcude('frontend.layout.')


	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- row -->
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Recent posts</h2>
							</div>
						</div>
						@foreach($posts as $post)

						
						<!-- post -->
						<div class="col-md-6">
							<div class="post">
								<a class="post-img" href="blog-post.html"><img src="{{ $post->image}}" alt="" class="img-thumnail" height="250px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.html">{{ $post->category->name }}</a>
									</div>
									<h3 class="post-title"><a href="blog-post.html">{{$post->title}}</a></h3>
									<ul class="post-meta">
										<li><a href="author.html">{{$post->user->name}}</a></li>
										<li>{{$post->created_at->diffForHumans()}}</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /post -->
						@endforeach

						<div class="clearfix visible-md visible-lg"></div>

					</div>
					<!-- /row -->

				</div>
				<div class="col-md-4">

					<!-- widget  -->
					

				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->





