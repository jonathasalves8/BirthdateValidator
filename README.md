# 🗓️ BirthdateValidator para Adianti Framework

Validador de campo para datas de nascimento no Adianti Framework.

## ✅ Funcionalidade

Este validador verifica se uma data de nascimento é válida com as seguintes regras:

- ❌ Rejeita `0000-00-00`
- ❌ Rejeita datas inválidas (como `31/02/2000`)
- ❌ Rejeita datas no futuro
- ❌ Rejeita idades acima de **130 anos**
- ✅ Aceita formatos `YYYY-MM-DD` ou `DD/MM/YYYY`

---

## 📦 Instalação

1. **Copie o arquivo** `BirthdateValidator.php` para sua pasta de validadores, por exemplo:

```bash
app/lib/BirthdateValidator.php
