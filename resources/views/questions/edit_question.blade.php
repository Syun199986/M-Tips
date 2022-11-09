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
					<a class="navbar-brand" href="/home">M-Tips</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/home">ホーム</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/post_question">質問投稿</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/my_posted_questions">マイ投稿</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="#">ログアウト</a>
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
			<div class="questions container border border-dark border-2 rounded-3 my-3">
                <div class="mb-3">
                    <h2 class="form-label">質問タイトル</h2>
			        <div class="d-flex flex-row">
                        <input type="text" class="form-control" id="" placeholder="(投稿した質問タイトル)">
                        <select class="form-select w-auto mx-2" aria-label="Default select example">
            				<option selected>(設定したカテゴリ)</option>
            				<option value="1">1</option>
            				<option value="2">2</option>
            				<option value="3">3</option>
    				    </select>
                    </div>
                </div>
                <div class="mb-3">
                    <h2 class="form-label">質問文</h2>
                    <textarea class="form-control" id="" rows="3" placeholder="(投稿した質問文)"></textarea>
                </div>
                <div class="d-flex justify-content-between">
      				<button type="button" class="">♪音楽・動画ファイルを追加</button>
      				<div>
          				<button type="button" class="">質問を削除</button>
          				<button type="button" class="">編集を完了</button>
      				</div>
				</div>
			</div>
		</main>
	</body>

</html>