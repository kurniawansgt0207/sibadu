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
        }
        failure {
          echo "Oh no, failure"
        }
        cleanup {
          echo "Don't care success or error"
        }
    }
}
