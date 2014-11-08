# 베이스 테마
## 개요
* 설명: [워드프레스](https://wordpress.org) 테마를 만들때 기초가 되는 파일들입니다.
* 작성자: [심철환](https://github.com/s10n)

## 테마 설치
* 워드프레스 테마 디렉토리에 이 리파지토리를 클론합니다.
```bash
cd wp-content/themes
git clone https://github.com/s10n/base.git
```
* 서브모듈을 초기화하고 업데이트합니다.
```bash
cd base
git submodule init
git submodule update
```
* `npm install`을 수행합니다. 이 명령은 자동으로 `bower.json`과 `package.json`의 디펜던시를 가져오고 `grunt build`를 실행합니다.
* 이제 워드프레스 관리자 화면에서 테마를 설정하십시오.

## 테마 개발하기
* `wp-config.php`를 열고, `define('WP_ENV', 'development');`를 입력하십시오. 개발 환경과 프로덕션 환경은 각각 서로 다른 스타일시트 및 자바스크립트 파일을 enqueue합니다. 이 내용은 `inc/enqueue.php`에서 확인할 수 있습니다.
* 아래의 grunt task들을 통해 스타일시트와 자바스크립트를 생성할 수 있습니다.

### Grunt Tasks
* `grunt clean`: grunt가 생성한 스타일시트와 자바스크립트를 삭제합니다.

#### 개발 환경
* `grunt css`: 스타일시트를 컴파일하고 소스맵을 생성합니다.
* `grunt js`: 자바스크립트 파일들을 연결합니다.
* `grunt`: `grunt css`와 `grunt js`를 수행합니다.
* `grunt watch`: less 파일이나 js 파일이 바뀔 때마다, 각각 `grunt css`와 `grunt js`를 수행합니다.

#### 프로덕션 환경
* `grunt build-css`: 스타일시트를 prefix, sort, lint, minify합니다.
* `grunt build-js`: 자바스크립트를 uglify합니다.
* `grunt build`: `grunt build-js`와 `grunt build-css`를 수행합니다.

## 테마 설정하기
* 테마 이름은 `style.css`에서 편집합니다.
* `functions.php`에 선언할 내용들은 `inc` 디렉토리 내부에 있습니다.
* 레이아웃 안쪽 컨텐츠들은 `templates` 디렉토리 내부에 있습니다.
