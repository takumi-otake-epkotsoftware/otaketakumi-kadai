const quiz = [
  {
    question: '世界で一番長い川は?',
    answers:[
        'ナイル川',
        'ミシシッピ川',
        '黄河',
        '信濃川'
    ],
  correct : 'ナイル川'
  },
  {
    question: '北進一刀流の使い手は誰?',
    answers:[
        '石田三成',
        '真田幸村',
        '坂本龍馬',
        '宮本武蔵'
    ],
  correct : '坂本龍馬'
  },{
    question: 'この中でニーチェの著作は?',
    answers:[
        '論語',
        '国家',
        '意思と表象としての世界',
        'この人を見よ'
    ],
  correct : 'この人を見よ'
  },{
    question: 'この中でウィドゲンシュタインの著作は?',
    answers:[
        '全体性と無限',
        '物質と精神',
        '物質論',
        '論理哲学論考'
    ],
  correct : '論理哲学論考'
  }
];

const quizLength=quiz.length;
let quizIndex = 0;
let score = 0;

const $button =document . getElementsByTagName('button');
let buttonLength = $button.length;

const setupQuiz=()=>{
      document.getElementById('js-question').textContent = quiz[quizIndex].question;
    let buttonIndex = 0;

    while(buttonIndex<buttonLength){
      $button[buttonIndex].textContent = quiz[quizIndex].answers[buttonIndex];
      buttonIndex++;
    }
}
setupQuiz();

const clickHandler =(e) =>{
  if(quiz[quizIndex].correct === e.target.textContent){
    window.alert('正解!');
    score++;
  }else{
    window.alert('不正解!');
  }

quizIndex++;

if(quizIndex < quizLength){
  setupQuiz()
}else{
  window.alert('終了!あなたの正解数は' + score + '/' + quizLength+'です!') ;
}

};


let handlerIndex = 0;
while (handlerIndex < buttonLength){
  $button[handlerIndex].addEventListener('click',(e) => {
    clickHandler(e);
  });
  handlerIndex++;
}

