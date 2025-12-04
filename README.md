# Community-Improvement-Poll-Deployment-AWS-3-Tier-LEMP-Stack-
A 3-Tier Community Poll Voting Application deployed on AWS using a LEMP Stack (Linux, Nginx, MySQL, PHP), demonstrating secure and scalable architecture for real-time voting.

# 🌐 AWS 3-Tier Community Poll / Voting Application (LEMP Stack)

A fully functional **3-Tier Community Poll Voting Application** deployed on **Amazon Web Services (AWS)** using a **LEMP Stack** (Linux, Nginx, MySQL, PHP).

This project demonstrates how to **design, configure, and deploy** a secure, scalable voting platform using **vote.html** and **submit.php**.

---

## 🏗️ Architecture Overview

| Tier                 | Component         | Function                                       | Network Placement |
| -------------------- | ----------------- | ---------------------------------------------- | ----------------- |
| **Web Tier**         | Nginx + vote.html | Handles frontend requests                      | Public Subnet     |
| **Application Tier** | submit.php        | Processes vote submissions and validates input | Private Subnet    |
| **Database Tier**    | MySQL             | Stores polls and votes                         | Private Subnet    |

**Flow:**
`User → Web Server → App Server → Database Server`

---

## ⚙️ Tech Stack

* **Cloud Platform:** AWS (VPC, Subnets, Route Tables, NAT Gateway, Internet Gateway, Elastic IPs, EC2 Instances)
* **Frontend:** vote.html (HTML, CSS, JS)
* **Backend:** submit.php (PHP)
* **Database:** MySQL 
* **Web Server:** Nginx
* **OS:** Amazon Linux 

---

## ☁️ AWS Infrastructure Setup

### VPC and Subnets

* Custom VPC: `10.0.0.0/16`
* Subnets:

  * `web-subnet` → Public
  * `app-subnet` → Private
  * `db-subnet` → Private

### EC2 Instances

| Server         | Placement | Purpose                          |
| -------------- | --------- | -------------------------------- |
| **Web Server** | Public    | Serves vote.html via Nginx       |
| **App Server** | Private   | Runs submit.php to process votes |
| **DB Server**  | Private   | Hosts MySQL database             |

---

## 🔒 Security Groups

| Server         | Allowed Source | Allowed Ports | Purpose                       |
| -------------- | -------------- | ------------- | ----------------------------- |
| **Web Server** | 0.0.0.0/0      | 80 (HTTP)     | Public access                 |
| **App Server** | Web SG         | 80 (HTTP)     | Accepts traffic from Web Tier |
| **DB Server**  | App SG         | 3306 (MySQL)  | Accepts traffic from App Tier |

---

## 🚀 Deployment Steps

### Web Server

```bash
sudo yum install nginx -y
sudo systemctl enable nginx
sudo systemctl start nginx

# Upload vote.html to /usr/share/nginx/html/
```

### App Server

```bash
sudo yum install php php-mysqlnd -y
sudo systemctl enable php-fpm
sudo systemctl start php-fpm

# Upload submit.php to /usr/share/nginx/html/
```

### Database Server

```bash
sudo yum install mariadb105-server -y
sudo systemctl enable mariadb
sudo systemctl start mariadb

# Create database and user
CREATE DATABASE pollapp;
CREATE USER 'polluser'@'<APP-SERVER-PRIVATE-IP>' IDENTIFIED BY 'securepassword';
GRANT ALL PRIVILEGES ON pollapp.* TO 'polluser'@'<APP-SERVER-PRIVATE-IP>';
FLUSH PRIVILEGES;
```

## ✅ Verification

* Open your browser: `http://<WEB-SERVER-PUBLIC-IP>/vote.html`
* Submit a vote using the form.
* Check MySQL:

```sql
SELECT * FROM votes;
```

## 🔮 Future Enhancements

* Add **Elastic Load Balancer** for high availability
* Integrate **SSL/TLS** via AWS Certificate Manager
* Automate deployment using **Terraform** or **CloudFormation**
* Add **real-time vote updates** (WebSockets or AJAX)

---

## 👨‍💻 Author

**Siddhesh Shinde**
Cloud Computing Enthusiast | AWS Learner | Full-Stack Developer

