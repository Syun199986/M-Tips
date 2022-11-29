<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<title>M-Tips</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>

	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<a class="navbar-brand" href="/">M-Tips</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/">ホーム</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/post_question">質問投稿</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/my_posted_questions">マイ投稿</a>
							</li>
							<li class="nav-item">
								<form method="POST" action="{{ route('logout') }}">
	                            @csrf
									<a class="nav-link" aria-current="page" href="route('logout')" 
											onclick="event.preventDefault();
	                                           			this.closest('form').submit();">
										ログアウト
									</a>
								</form>
							</li>
						</ul>
						<select class="form-select w-auto" aria-label="Default select example">
							<option selected>▼カテゴリ選択</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						<form class="d-flex">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success" type="submit">Search</button>
						</form>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<div class="edit_question container border border-dark border-2 rounded-3 my-3">
                <form action="/questions/{{ $question->id }}" method="POST" enctype="multipart/form-data" id="text_form">
                	@csrf
                	@method('PUT')
                	<div class="mb-3">
	                    <h2 class="form-label">質問タイトル</h2>
				        <div class="d-flex flex-row">
	                        <input form="text_form" type="text" class="form-control" name="question[title]" value="{{ $question->title }}">
	            <!--            <select class="form-select w-auto mx-2" aria-label="Default select example">-->
	            <!--				<option selected>(設定したカテゴリ)</option>-->
	            <!--				<option value="1">1</option>-->
	            <!--				<option value="2">2</option>-->
	            <!--				<option value="3">3</option>-->
	    				    <!--</select>-->
		      			<input form="text_form" type="text" name="question[category_id]" class="" value="{{ $question->category_id }}"/>
	                    </div>
                	</div>
	                <div class="mb-3">
	                    <h2 class="form-label">質問文</h2>
	                    <textarea form="text_form" class="form-control" name="question[body]" rows="3">{{ $question->body }}</textarea>
	                </div>
						@if($question->file_path == NULL)
			                <div class="d-flex justify-content-between">
						      	<input form="text_form" type="file" name="question_file" id="question_file" class=""/>
							    <button form="text_form" type="submit" class="">編集を完了</button>
							</div>
							<input type="button" id="file_clear" value="ファイル選択解除" onclick="fileClear();"/>
						@else
		                	<div class="d-flex justify-content-between">
								<button type="submit" formaction="/questions/{{ $question->id }}/delete_file" id="delete_file">
									ファイルを削除
								</button>								
								<button form="text_form" type="submit" class="">編集を完了</button>
							</div>
							@if(strrpos($question->file_path, '.png'))
							    <img src="{{ $question->file_path }}">
							@elseif(strrpos($question->file_path, '.mp3'))
								<audio controls src="{{ $question->file_path }}">
						            <a href="{{ $question->file_path }}">
						            	Download audio
	            					</a>
	            				</audio>
							@endif
						@endif
					</div>
                </form>
			</div>
		</main>
	</body>
	<script>
		function fileClear(){
		  let qfile = document.getElementById("question_file");
		  qfile.value = "";
		}
	</script>

</html>