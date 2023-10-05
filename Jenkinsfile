pipeline {
    agent any
    stages {
        stage('Fetch Code') {
            steps {
                script {
                    // Checkout code from the 'main' branch
                    checkout([$class: 'GitSCM', branches: [[name: 'main']], userRemoteConfigs: [[url: 'https://github.com/azizulhoffice/event']]])
                }
                echo 'Repository Cloning.....'
            }
        }
        stage('Build') {
            steps {
                sh 'composer install'
            }
            post {
                success {
                    echo 'Composer Installing.....'
                }
            }
        }
        stage('Ready') {
            steps {
                sh 'php artisan optimize'
            }
        }
        stage('SonarQube Analysis') {
            steps {
                script {
                    // Set SonarQube environment
                    def scannerHome = tool 'sonar5.0' // Assuming 'sonar5.0' is configured as a tool in Jenkins

                    // Run SonarScanner analysis
                    sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=event -Dsonar.sources=. -Dsonar.host.url=http://localhost:9000 -Dsonar.login=sqp_1da8254d94f81a988833ff4587458c95d8d7209d"
                }
            }
        }
    }
}
