# Soru/Cevap işlemleri 
_________________


### 1- Init Object for Usage

````php
   use ksmylmz\trendyol\Trendyol;
    ......
    $isTeststage = true;
    $trendyol  = new Trendyol({username},{password},{merchantid},$isTestStage);
````

### 2- Soruları Listeleme

````php
    $result =$this->trendyol->getQuestions();
    var_dump($result);
````

### 3- Sorulara Cevap Verme

````php
    $questioınID = 123456;
    $answerText = "bla bla bla";
    //answer-question
    $result =$this->trendyol->question->answerQuestion($questioınID,$answerText); 
    var_dump($result);
````