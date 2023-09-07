pipeline {
    agent any 
    stages {
        stage('Hello'){
            steps {
                echo 'Mulai Menyapa'
                echo 'Hello World...!!!'
                echo 'Akhir Menyapa'
            }
        }
        stage('Baris 1'){
            steps {
                echo 'Memulai'
                echo 'Ini adalah baris ke-1'
                echo 'Akhiri'
            }
        }
        stage('Perulangan'){
            steps {
                echo 'Ini baris perulangan'
                script {
                    for(int i = 0; i < 10; i++){
                        echo "Perulangan Ke-${i}"
                    }
                }
                echo 'Selesai'
            }
        }
    }
    
    post {
        always {
            echo "I will always say Hello again!"
        }
        success {
            echo "Yay, success"
            slackSend channel: "cordovanetwork", color: '#BADA55', message: "Pipeline successfully"
        }
        failure {
            echo "Oh no, failure"
            slackSend channel: "cordovanetwork", color: '#DACC34', message: "Pipeline Failed"
        }
        cleanup {
            echo "Don't care success or error"
        }
    }
}
