<x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<title>M-Tips</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	</head>

	<body class="bg-light">
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-white">
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
								<a class="nav-link active" aria-current="page" href="/post_question">質問投稿</a>
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
					</div>
				</div>
			</nav>
		</header>
		<main>
			<div class="post_question container border-gray-300 border-1 rounded-3 mt-5 px-4 py-2 bg-white" id="question_form">
				<form action="/" method="POST" enctype="multipart/form-data">
				@csrf
	                <div class="mb-3">
	                    <h2 class="form-label">質問タイトル</h2>
				        <div class="d-flex flex-row">
	                        <input type="text" name="question[title]" class="form-control" placeholder="質問タイトルを入力" value="{{ old('question.title') }}"/>
	            <!--            <select class="form-select w-auto mx-2" aria-label="Default select example">-->
	            <!--				<option selected>▼カテゴリ選択</option>-->
	            <!--				<option value="1">1</option>-->
	            <!--				<option value="2">2</option>-->
	            <!--				<option value="3">3</option>-->
	    				    <!--</select>-->
		      				<!--<input type="text" name="question[category_id]" class="" placeholder="テスト用カテゴリーIDを入力" value="{{ old('question.category_id') }}"/>-->
	                    </div>
	                    <p class="title__error" style="color:red">{{ $errors->first('question.title') }}</p>
		                <p class="title__error" style="color:red">{{ $errors->first('question.category_id') }}</p>
	                </div>
	                <div class="mb-3">
	                    <h2 class="form-label">質問文</h2>
	                    <textarea class="form-control" name="question[body]" rows="3" placeholder="質問文を入力" value="{{ old('question.body') }}"></textarea>
	                    <p class="title__error" style="color:red">{{ $errors->first('question.body') }}</p>
	                </div>
	                <div class="d-flex justify-content-between">
						<input class="form-control form-control" id="question_file" name="question_file" type="file" accept="image/*,.aac,.m4a,.mp1,.mp2,.mp3,.mpg,.mpeg,.oga,.ogg,.wav,.wabm">
	      				<input type="submit" value="投稿する" class="btn btn-primary ml-5"/>
					</div>
		      		<input type="hidden" name="question[user_name]" value="{{ Auth::user()->name }}"/>
		      		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
		      		<input type="hidden" name="question_id" value="{{ $question->id }}"/>
				</form>
				<p class="mb-0" style="font-size: 15px; opacity: 0.7;">画像、音声ファイルを選択</p>
				<input class="btn btn-outline-danger btn-sm mt-2" type="button" id="file_clear" value="ファイル選択解除" onclick="fileClear();"/>
			</div>
		</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
	<script>
		function fileClear(){
		  let qfile = document.getElementById("question_file");
		  qfile.value = "";
		}
	</script>
</html>
</x-guest-layout>