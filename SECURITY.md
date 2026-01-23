# Política de Segurança

## 📋 Índice

- [Versões Suportadas](#-versões-suportadas)
- [Reportando uma Vulnerabilidade](#-reportando-uma-vulnerabilidade)
- [Políticas de Segurança](#-políticas-de-segurança)
- [Checklist de Segurança](#-checklist-de-segurança)
- [Configurações de Segurança](#-configurações-de-segurança)
- [Boas Práticas](#-boas-práticas)

---

## 🔒 Versões Suportadas

Este projeto atualmente suporta as seguintes versões com atualizações de segurança: 

| Versão | Suportada           | Status        |
| ------ | ------------------- | ------------- |
| main   | : white_check_mark: | Ativa         |
| < 1.0  | :x:                 | Descontinuada |

**Dependências Principais:**
- Laravel:  ^12.0
- PHP: ^8.2
- laravel/octane: ^2.13
- open-telemetry/sdk: ^1.7
- open-telemetry/exporter-otlp: ^1.3
- spatie/laravel-open-telemetry: ^0.0.11
- JWT Auth: ^2.2
- darkaonline/l5-swagger: ^9.0
- phpunit/phpunit: ^11.5

---

## 🚨 Reportando uma Vulnerabilidade

### **Não abra issues públicas para vulnerabilidades de segurança!**

Se você descobrir uma vulnerabilidade de segurança neste projeto, por favor, reporte de forma responsável:

### **Como Reportar:**

1. **Email:** Envie um email para:  `douglasjr0809@gmail.com`
2. **Subject:** `[SECURITY] Descrição breve da vulnerabilidade`
3. **Conteúdo mínimo:**
   - Descrição detalhada da vulnerabilidade
   - Passos para reproduzir
   - Impacto potencial
   - Versão afetada
   - Sugestão de correção (se possível)

### **Template de Reporte:**

```
Título: [SECURITY] SQL Injection em endpoint X

Descrição: 
Descobri uma possível vulnerabilidade de SQL Injection no endpoint /api/user/{id}

Passos para reproduzir: 
1. Fazer requisição GET para /api/user/1' OR '1'='1
2. Observar que retorna todos os usuários

Impacto: 
Alto - Permite acesso não autorizado a dados

Versão afetada: 
main branch (commit abc123)

Sugestão de correção:
Usar prepared statements ou validação adequada do parâmetro ID
```

### **O que esperar:**

- ✅ Resposta inicial em **48 horas**
- ✅ Confirmação da vulnerabilidade em **5 dias úteis**
- ✅ Correção em **30 dias** (dependendo da severidade)
- ✅ Crédito público após correção (se desejar)

### **Divulgação Responsável:**

Por favor, aguarde nossa correção antes de divulgar publicamente. Agradecemos sua cooperação em manter nosso projeto seguro para uso. 

---

## 🛡️ Políticas de Segurança

### **1. Autenticação e Autorização**

- ✅ Autenticação dual:  JWT (API) e Session (Web)
- ✅ Tokens JWT com expiração configurável
- ✅ Rate limit para até 60 requisições no periodo de 1 minuto no middleware de CheckUserPermission
- ✅ Permissão de usuario já configurada por tabela, registrado em uma migration/seeder exemplo na rota DELETE de users na API

### **2. Validação de Dados**

- ✅ Form Requests customizados para todas as entradas
- ✅ Validação no lado do servidor (nunca confiar apenas no cliente)
- ✅ Sanitização de dados antes de persistir
- ✅ Type hints e return types em todos os métodos

### **3. Proteção contra Ataques Comuns**

| Ataque                | Proteção Implementada |
|-----------------------|----------------------------------------|
| **SQL Injection**     | Query Builder / Prepared Statements    |
| **XSS**               | Blade escapa HTML automaticamente      |
| **CSRF**              | Token CSRF em formulários web          |
| **Mass Assignment**   | `$fillable` definido nos Models        |
| **Brute Force**       | Rate limiting (recomendado configurar) |
| **Session Hijacking** | Tokens seguros, HTTPOnly cookies       |

### **4. Criptografia**

- ✅ Senhas hasheadas com bcrypt (12 rounds)
- ✅ APP_KEY único por ambiente
- ✅ JWT_SECRET único e complexo

### **5. Controle de Acesso**

- ✅ Guards separados para Web e API
- ✅ Middlewares customizados por camada

---

# Recomendado
- [ ] Rate limiting configurado
- [ ] Logs de auditoria habilitados
- [ ] Backups automáticos configurados
- [ ] Atualizações de dependências agendadas
- [ ] Swagger protegido ou desabilitado

---

## 📞 Contato

Para questões de segurança, entre em contato:

- **Email:** [douglasjr0809@gmail.com]
- **GitHub:** [@djsilvajr](https://github.com/djsilvajr)

---

## 📜 Licença

Este documento está licenciado sob [MIT License](LICENSE).

---

**Última atualização:** 2026-01-23