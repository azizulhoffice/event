pipeline {
    agent any
    stages {
        stage('Fetch Code'){
            steps{
                script {
                    // Checkout code from the 'main' branch
                    checkout([$class: 'GitSCM', branches: [[name: 'main']], userRemoteConfigs: [[url: 'https://github.com/azizulhoffice/event']]])
                }
                echo 'Repository Cloning.....'
            }
        }
        stage('Build'){
            steps{
                sh 'composer install'
            }
            post {
                success {
                    echo 'Composer Installing.....'
                }
            }
        }
        stage('Ready') {
            steps{
                sh 'php artisan optimize'
            }
        }
    }
}
